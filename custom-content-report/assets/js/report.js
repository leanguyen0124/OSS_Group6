( function () {
	'use strict';

	const dialog = document.querySelector( '.ccr-dialog' );
	if ( ! dialog || typeof CCR_REPORT === 'undefined' ) {
		return;
	}

	const form = dialog.querySelector( '.ccr-report-form' );
	const typeInput = form.querySelector( '[name="content_type"]' );
	const idInput = form.querySelector( '[name="content_id"]' );
	const message = form.querySelector( '.ccr-report-form__message' );
	const submit = form.querySelector( '[type="submit"]' );
	let trigger = null;

	function closeDialog() {
		dialog.hidden = true;
		document.body.classList.remove( 'ccr-dialog-open' );
		form.reset();
		message.textContent = '';
		if ( trigger ) {
			trigger.focus();
		}
	}

	document.addEventListener( 'click', function ( event ) {
		const button = event.target.closest( '.ccr-report-button' );
		if ( button ) {
			trigger = button;
			typeInput.value = button.dataset.contentType;
			idInput.value = button.dataset.contentId;
			dialog.hidden = false;
			document.body.classList.add( 'ccr-dialog-open' );
			dialog.querySelector( 'select' ).focus();
			return;
		}

		if ( event.target.closest( '[data-ccr-close]' ) ) {
			closeDialog();
		}
	} );

	document.addEventListener( 'keydown', function ( event ) {
		if ( 'Escape' === event.key && ! dialog.hidden ) {
			closeDialog();
		}
	} );

	form.addEventListener( 'submit', async function ( event ) {
		event.preventDefault();
		submit.disabled = true;
		message.textContent = CCR_REPORT.sending;

		const data = new FormData( form );
		data.append( 'action', 'ccr_report_activity' );
		data.append( 'nonce', CCR_REPORT.nonce );

		try {
			const response = await fetch( CCR_REPORT.ajaxUrl, {
				method: 'POST',
				credentials: 'same-origin',
				body: data,
			} );
			const result = await response.json();

			if ( ! result.success ) {
				throw new Error( result.data && result.data.message ? result.data.message : CCR_REPORT.error );
			}

			removeReportedContent( typeInput.value, idInput.value );
			closeDialog();
		} catch ( error ) {
			message.textContent = error.message || CCR_REPORT.error;
		} finally {
			submit.disabled = false;
		}
	} );

	function removeReportedContent( contentType, contentId ) {
		if ( 'activity' === contentType ) {
			const activity = document.getElementById( 'activity-' + contentId ) || trigger.closest( '.activity-item, li' );
			if ( activity ) {
				activity.remove();
			}
			return;
		}

		const topic = document.getElementById( 'bbp-topic-' + contentId + '-lead' ) || document.getElementById( 'bbp-topic-' + contentId );
		if ( topic ) {
			topic.remove();
			return;
		}

		const header = document.getElementById( 'post-' + contentId );
		if ( header ) {
			const content = header.nextElementSibling;
			header.remove();
			if ( content && content.matches( '.reply, .topic, .type-reply, .type-topic' ) ) {
				content.remove();
			}
		}
	}
}() );

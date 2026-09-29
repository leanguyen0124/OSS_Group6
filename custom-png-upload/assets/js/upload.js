( function () {
	'use strict';

	if ( typeof CPI_UPLOAD === 'undefined' ) {
		return;
	}

	document.addEventListener( 'change', async function ( event ) {
		if ( ! event.target.matches( '.cpi-file-input' ) ) {
			return;
		}

		const input = event.target;
		const uploader = input.closest( '.cpi-uploader' );
		const form = input.closest( 'form' );
		const status = uploader.querySelector( '.cpi-upload-status' );
		const preview = uploader.querySelector( '.cpi-preview' );
		const existingCount = Number( uploader.dataset.existingCount || 0 );
		const currentCount = existingCount + form.querySelectorAll( 'input[name="cpi_attachment_ids[]"]' ).length;
		const files = Array.from( input.files );

		if ( currentCount + files.length > Number( CPI_UPLOAD.maxImages ) ) {
			status.textContent = CPI_UPLOAD.tooMany;
			input.value = '';
			return;
		}

		for ( const file of files ) {
			if ( 'image/png' !== file.type || ! file.name.toLowerCase().endsWith( '.png' ) ) {
				status.textContent = CPI_UPLOAD.invalidType;
				continue;
			}

			if ( file.size > Number( CPI_UPLOAD.maxFileSize ) ) {
				status.textContent = CPI_UPLOAD.tooLarge;
				continue;
			}

			status.textContent = CPI_UPLOAD.uploading;
			input.disabled = true;

			try {
				const data = new FormData();
				data.append( 'action', 'cpi_upload_png' );
				data.append( 'nonce', CPI_UPLOAD.nonce );
				data.append( 'cpi_png', file, file.name );

				const response = await fetch( CPI_UPLOAD.ajaxUrl, {
					method: 'POST',
					credentials: 'same-origin',
					body: data,
				} );
				const result = await response.json();

				if ( ! result.success ) {
					throw new Error( result.data && result.data.message ? result.data.message : CPI_UPLOAD.uploadError );
				}

				const hidden = document.createElement( 'input' );
				hidden.type = 'hidden';
				hidden.name = 'cpi_attachment_ids[]';
				hidden.value = result.data.id;
				form.appendChild( hidden );

				const item = document.createElement( 'div' );
				item.className = 'cpi-preview__item';
				item.dataset.attachmentId = result.data.id;
				item.innerHTML = '<img src="' + escapeAttribute( result.data.url ) + '" alt="">' +
					'<button type="button" class="cpi-remove-image" aria-label="' + escapeAttribute( CPI_UPLOAD.remove ) + '">&times;</button>';
				preview.appendChild( item );
				status.textContent = '';
			} catch ( error ) {
				status.textContent = error.message || CPI_UPLOAD.uploadError;
			} finally {
				input.disabled = false;
			}
		}

		input.value = '';
	} );

	document.addEventListener( 'click', async function ( event ) {
		const button = event.target.closest( '.cpi-remove-image' );
		if ( ! button ) {
			return;
		}

		const item = button.closest( '.cpi-preview__item' );
		const uploader = button.closest( '.cpi-uploader' );
		const form = button.closest( 'form' );
		const attachmentId = item.dataset.attachmentId;
		button.disabled = true;

		const data = new URLSearchParams();
		data.append( 'action', 'cpi_delete_pending_png' );
		data.append( 'nonce', CPI_UPLOAD.nonce );
		data.append( 'attachment_id', attachmentId );

		try {
			const response = await fetch( CPI_UPLOAD.ajaxUrl, {
				method: 'POST',
				credentials: 'same-origin',
				headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
				body: data.toString(),
			} );
			const result = await response.json();
			if ( ! result.success ) {
				throw new Error( result.data && result.data.message ? result.data.message : CPI_UPLOAD.uploadError );
			}

			const hidden = form.querySelector( 'input[name="cpi_attachment_ids[]"][value="' + attachmentId + '"]' );
			if ( hidden ) {
				hidden.remove();
			}
			item.remove();
		} catch ( error ) {
			uploader.querySelector( '.cpi-upload-status' ).textContent = error.message || CPI_UPLOAD.uploadError;
			button.disabled = false;
		}
	} );

	function escapeAttribute( value ) {
		return String( value )
			.replace( /&/g, '&amp;' )
			.replace( /"/g, '&quot;' )
			.replace( /</g, '&lt;' )
			.replace( />/g, '&gt;' );
	}
}() );

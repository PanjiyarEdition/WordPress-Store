const afterDOMInitiated = (cb) => {
    if (/comp|inter|loaded/.test(document.readyState)) {
        cb()
    } else {
        document.addEventListener('DOMContentLoaded', cb, false)
    }
}

afterDOMInitiated(() => {
    const licButton = document.querySelector('#rishi-cmp-activatelic');
    const deActivateButton = document.querySelector('.deactivateMessage');
    const licKey = document.querySelector('#rishi-cmp-license-key');
    const makeAction = async (LicNonce, licButton) => {

        if ('' === licKey.value) {
            alert('Enter License Key first!!');
            return;
        }

        const rshMmsgned = document.querySelector('#rsh-msgned');

        const body = new FormData()

        body.append('nonce', LicNonce);
        body.append('license_key', licKey.value)
        body.append(
            'action',
            'rishi_cmp_activate_license_fromplgns'
        )

        // Loading indicator
        licButton.disabled = true;
        licButton.classList.add('is-loading');
        rshMmsgned.classList.add('updating-message');
        try {
            await fetch(ajaxurl, {
                method: 'POST',
                body,
            }).then((response) => response.json()).then((data) => {
                if (!data.success) {
                    alert(data.data.license_activation_error);
                } else {
                    location.reload();
                }
            });

        } catch (e) { }

        //!! Remove Loading
        licButton.disabled = false;
        licButton.classList.remove('is-loading');
        rshMmsgned.classList.remove('updating-message');
    }
    if (null !== licButton) {
        licButton.addEventListener('click', (e) => {
            e.preventDefault();
            let LicNonce = licButton.dataset.nonce;
            makeAction(LicNonce, licButton);
        })
    }
    if (null !== deActivateButton) {
        deActivateButton.addEventListener('click', (e) => {
            e.preventDefault();
            let url = deActivateButton.firstChild.attributes.href.value;
            let params = new URLSearchParams(url);
            const body = new FormData()

            body.append('nonce', deActivateButton.firstChild.dataset.nonce);
            body.append('license_key', params.get('license'))
            body.append(
                'action',
                'rishi_cmp_deactivate_license_fromplgns'
            )

            deActivateButton.classList.add('updatingMsg');
            try {
                fetch(ajaxurl, {
                    method: 'POST',
                    body
                }).then((response) => response.json()).then((data) => {
                    deActivateButton.classList.remove('updatingMsg');
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.data.message);
                    }
                });

            } catch (e) { }
        })
    }
})
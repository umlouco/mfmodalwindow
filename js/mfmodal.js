(function () {
    var activeModal = null;
    var activeTrigger = null;
    var backdrop = null;

    function moveModalsToBody() {
        var modals = document.querySelectorAll('[data-mfmodal-root]');

        Array.prototype.forEach.call(modals, function (modal) {
            if (modal.parentElement !== document.body) {
                document.body.appendChild(modal);
            }
        });
    }

    function getFocusableElements(container) {
        return Array.prototype.slice.call(
            container.querySelectorAll(
                'a[href], button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])'
            )
        ).filter(function (element) {
            return !element.hasAttribute('hidden') && element.offsetParent !== null;
        });
    }

    function ensureBackdrop() {
        if (backdrop) {
            return backdrop;
        }

        backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop fade mf-modal-backdrop';
        backdrop.addEventListener('click', function () {
            if (activeModal) {
                closeModal(activeModal);
            }
        });
        return backdrop;
    }

    function syncIframe(modal, isOpen) {
        var iframe = modal.querySelector('iframe[data-mfmodal-iframe-url]');

        if (!iframe) {
            return;
        }

        if (isOpen) {
            iframe.setAttribute('src', iframe.getAttribute('data-mfmodal-iframe-url') || '');
            return;
        }

        iframe.setAttribute('src', '');
    }

    function trapFocus(event) {
        if (!activeModal || event.key !== 'Tab') {
            return;
        }

        var focusable = getFocusableElements(activeModal);
        if (!focusable.length) {
            event.preventDefault();
            return;
        }

        var first = focusable[0];
        var last = focusable[focusable.length - 1];

        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
            return;
        }

        if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    }

    function handleKeydown(event) {
        if (event.key === 'Escape' && activeModal) {
            closeModal(activeModal);
            return;
        }

        trapFocus(event);
    }

    function openModal(modal, trigger) {
        if (!modal) {
            return;
        }

        if (activeModal && activeModal !== modal) {
            closeModal(activeModal);
        }

        activeModal = modal;
        activeTrigger = trigger || null;
        modal.style.display = 'block';
        modal.classList.add('show');
        modal.removeAttribute('aria-hidden');
        document.body.classList.add('mf-modal-open');

        var currentBackdrop = ensureBackdrop();
        if (!currentBackdrop.parentNode) {
            document.body.appendChild(currentBackdrop);
        }
        currentBackdrop.classList.add('show');

        syncIframe(modal, true);

        var focusable = getFocusableElements(modal);
        var preferredFocus = modal.querySelector('[data-mfmodal-close]') || focusable[0] || modal;
        preferredFocus.focus();

        document.addEventListener('keydown', handleKeydown);
    }

    function closeModal(modal) {
        if (!modal) {
            return;
        }

        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
        modal.style.display = 'none';
        syncIframe(modal, false);

        if (backdrop) {
            backdrop.classList.remove('show');
            if (backdrop.parentNode) {
                backdrop.parentNode.removeChild(backdrop);
            }
        }

        document.body.classList.remove('mf-modal-open');
        document.removeEventListener('keydown', handleKeydown);

        if (activeTrigger) {
            activeTrigger.focus();
        }

        activeModal = null;
        activeTrigger = null;
    }

    document.addEventListener('click', function (event) {
        var openTrigger = event.target.closest('[data-mfmodal-open]');
        if (openTrigger) {
            var selector = openTrigger.getAttribute('data-mfmodal-open');
            openModal(document.querySelector(selector), openTrigger);
            event.preventDefault();
            return;
        }

        var closeTrigger = event.target.closest('[data-mfmodal-close]');
        if (closeTrigger) {
            closeModal(closeTrigger.closest('.modal'));
            event.preventDefault();
            return;
        }

        if (activeModal && event.target === activeModal) {
            closeModal(activeModal);
        }
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', moveModalsToBody);
    } else {
        moveModalsToBody();
    }
})();
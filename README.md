# MF Modal Button

MF Modal Button is a lightweight WordPress plugin that provides shortcodes for opening content inside a Bootstrap modal window.

It supports two use cases:

- Rendering inline WordPress content inside a modal
- Loading an external page inside an iframe modal

The plugin bundles Bootstrap 5 assets and renders modal markup compatible with Bootstrap 5.

## Included assets

The plugin enqueues:

- `css/bootstrap.min.css`
- `js/bootstrap.min.js`
- `css/mfmodal.css`

The custom stylesheet adds:

- link-style defaults for the open trigger and close control
- modal/backdrop stacking fixes so the content stays above the overlay
- basic iframe sizing for iframe-based modals

## Shortcodes

### `mf_modal`

Use this shortcode when the modal content is provided directly inside the shortcode body.

Example:

```shortcode
[mf_modal label="Privacy policy" title="Privacy Policy"]
<p>This site processes personal data according to the privacy policy.</p>
[/mf_modal]
```

Supported attributes:

- `label`: text shown on the trigger element. Default: `Open`
- `title`: optional modal heading shown in the header. Default: empty
- `button_class`: CSS classes applied to the trigger button. Default: `mf-modal-trigger`
- `modal_width`: Bootstrap modal dialog size class such as `modal-lg`. Default: `modal-lg`
- `close_class`: CSS classes applied to the close button. Default: `mf-modal-close`

Behavior:

- The trigger opens a Bootstrap modal using `data-bs-toggle` and `data-bs-target`
- If `title` is set, the plugin renders an `h4` in the modal header
- The close control displays only the `×` symbol by default
- Nested shortcodes inside the modal body are processed with `do_shortcode()`

### `mf_modal_iframe`

Use this shortcode when the modal should load an external or internal URL in an iframe.

Example:

```shortcode
[mf_modal_iframe label="Privacy policy" title="Privacy Policy" url="https://example.com/privacy-policy/"]
```

Supported attributes:

- `url`: URL loaded into the iframe when the modal opens. Default: empty
- `label`: text shown on the trigger element. Default: `Open`
- `title`: optional modal heading shown in the header. Default: empty
- `button_class`: CSS classes applied to the trigger button. Default: `mf-modal-trigger`
- `modal_width`: Bootstrap modal dialog size class such as `modal-lg`. Default: `modal-lg`
- `close_class`: CSS classes applied to the close button. Default: `mf-modal-close`
- `modalid`: optional unique identifier for the modal instance. Default: generated with `uniqid()`

Behavior:

- The iframe `src` is set only when the modal is shown
- The iframe `src` is cleared when the modal is hidden
- This avoids leaving remote content active after the modal closes

## Default styling

By default, the plugin styles the trigger and close control like plain text links rather than solid Bootstrap buttons.

Defaults:

- Open trigger: `mf-modal-trigger`
- Close control: `mf-modal-close`

You can override either with shortcode attributes if the theme needs different classes.

Example:

```shortcode
[mf_modal label="Open terms" button_class="btn btn-link" close_class="btn btn-link" title="Terms"]
Content here.
[/mf_modal]
```

## Files

- `mfmodal.php`: registers assets and shortcodes
- `views/modal.php`: template for inline modal content
- `views/modaliframe.php`: template for iframe modal content
- `css/mfmodal.css`: plugin-specific modal styling adjustments

## Notes

- The plugin expects Bootstrap 5 modal behavior
- The modal header title is optional
- The plugin generates unique modal IDs automatically unless `modalid` is passed to `mf_modal_iframe`

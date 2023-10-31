/**
 * v1.0.2
 */
(function ($) {
    'use strict';

    /**
     * Add class exclude-quick-save to the form you want to exclude from quick save
     */
    function quickSaveButton() {
        this.init = function () {
            this.form = jQuery('form[action="options.php"]').not('.exclude-quick-save');
            this.addButton();
            this.onClick();
        }

        this.addButton = function () {
            if (this.form.length == 1) {
                var button = jQuery('<button type="submit" id="pisol-quick-save" class="btn btn-danger btn-lg">Save Changes</button>').css({
                    'position': 'fixed',
                    'top': '50%',
                    'right': '-66px',
                    'z-index': '100000000000',
                    'transform': 'rotate(-90deg)',
                    'border-color': '#FFFFFF',
                    'width': '170px'
                });
                this.form.append(button);
            }
        }

        this.onClick = function () {
            var parent = this;
            jQuery(document).on('click', '#pisol-quick-save', function (e) {
                parent.form.trigger('submit');
                jQuery(this).text('Saving....');
            });
        }

    }

    jQuery(function ($) {
        var quickSaveButtonObj = new quickSaveButton();
        quickSaveButtonObj.init();
    });

})(jQuery);
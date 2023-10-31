(function($){
    "use strict";
    let functions = {
        showVerticalResults: function () {
            let $this = this;

            $this.showResultsBox();

            if ($this.n('items').length > 0) {
                // noinspection JSUnresolvedVariable
                let count = (($this.n('items').length < $this.o.itemscount) ? $this.n('items').length : $this.o.itemscount);
                count = count <= 0 ? 9999 : count;
                let groups = $('.asl_group_header', $this.n('resultsDiv'));

                // So if the result list is short, we dont even need to do the match
                // noinspection JSUnresolvedVariable
                if ($this.o.itemscount == 0 || $this.n('items').length <= $this.o.itemscount) {
                    $this.n('results').css({
                        height: 'auto'
                    });
                } else {

                    // Set the height to a fictive value to refresh the scrollbar
                    // .. otherwise the height is not calculated correctly, because of the scrollbar width.
                    if ( $this.call_num < 1 )
                        $this.n('results').css({
                            height: "30px"
                        });

                    if ( $this.call_num < 1 ) {
                        // Here now we have the correct item height values with the scrollbar enabled
                        let i = 0,
                            h = 0,
                            final_h = 0,
                            highest = 0;

                        $this.n('items').forEach(function () {
                            h += $(this).outerHeight(true);
                            if ($(this).outerHeight(true) > highest)
                                highest = $(this).outerHeight(true);
                            i++;
                        });

                        // Get an initial height based on the highest item x viewport
                        final_h = highest * count;
                        // Reduce the final height to the overall height if exceeds it
                        if (final_h > h)
                            final_h = h;

                        // Count the average height * viewport size
                        i = i < 1 ? 1 : i;
                        h = h / i * count;

                        /*
                         Groups need a bit more calculation
                         - determine group position by index and occurence
                         - one group consists of group header, items + item spacers per item
                         - only groups within the viewport are calculated
                         */
                        if (groups.length > 0) {
                            groups.forEach(function (el, index) {
                                let position = Array.prototype.slice.call(el.parentNode.children).indexOf(el),
                                    group_position = position - index - Math.floor(position / 3);
                                if (group_position < count) {
                                    final_h += $(this).outerHeight(true);
                                }
                            });
                        }
                        $this.n('results').css({
                            height: final_h + 'px'
                        });

                    }
                }

                // Mark the last item
                $this.n('items').last().addClass('asl_last_item');
                // Before groups as well
                $this.n('results').find('.asl_group_header').prev('.item').addClass('asl_last_item');
                if ($this.o.highlight == 1) {
                    // noinspection JSUnresolvedVariable
                    $("div.item", $this.n('resultsDiv')).highlight($this.n('text').val().split(" "), {
                        element: 'span', className: 'highlighted', wordsOnly: $this.o.highlightWholewords
                    });
                }


            }
            $this.resize();
            if ($this.n('items').length == 0) {
                $this.n('results').css({
                    height: 'auto'
                });
            }
            $this.n('results').css({
                'overflowY': 'auto'
            });

            // Scroll to top
            $this.n('results').get(0).scrollTop = 0;

            $this.fixResultsPosition(true);
            $this.searching = false;
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);
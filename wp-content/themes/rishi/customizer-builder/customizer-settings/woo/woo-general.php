<?php
$wooprefix = 'woo_';

$defaults = rishi__cb__get_layout_defaults();

$colordefaults = rishi__cb__get_color_defaults();

$_inner_options = apply_filters( 'rishi_woo_general_customizer_settings', 
    [
        rishi__cb_customizer_rand_md5() => [
            'type'  => 'rt-title',
            'label' => __('WooCommerce Structure', 'rishi'),
        ],
        rishi__cb_customizer_rand_md5() => [
            'title'   => __('General', 'rishi'),
            'type'    => 'tab',
            'options' => [
                // WooCommerce Layout
                'woocommerce_sidebar_layout' => [
                    'label'   => __('WooCommerce Layout', 'rishi'),
                    'type'    => 'rt-image-picker',
                    'value'   => $defaults['woocommerce_sidebar_layout'],
                    'attr'  => [
                        'data-type'    => 'background',
                        'data-usage'   => 'layout-style',
                        'data-columns' => '2',
                    ],
                    'desc' => __('Choose site layout.', 'rishi'),
                    'choices' => [
                        'right-sidebar' => [
                            'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="102" height="102" viewBox="0 0 275 275"><defs><clipPath id="clip-_1"><rect width="275" height="275"/></clipPath></defs><g id="_1" data-name="1" clip-path="url(#clip-_1)"><rect width="275" height="275"/><g id="Group_5800" data-name="Group 5800" transform="translate(0 5)"><g id="Group_5781" data-name="Group 5781" transform="translate(28 10)"><g id="Group_5777" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304" data-name="Path 304" d="M0,0H63.579V36.116H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_" data-name="picture (1)" transform="translate(19.866 8.365)" opacity="0.4"><path id="Path_198" data-name="Path 198" d="M82.444,115.074A3.074,3.074,0,1,0,85.518,112,3.074,3.074,0,0,0,82.444,115.074Zm6.148,15.37H64l6.148-16.395,8.2,10.247,4.1-3.074Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780" data-name="Group 5780" transform="translate(0 36.7)"><path id="Path_23077" data-name="Path 23077" d="M0,43.409H63.654V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779" data-name="Group 5779" transform="translate(4.837 5.805)"><g id="Group_5778" data-name="Group 5778" transform="translate(9.548 19.025)"><g id="Rectangle_850" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="33.95" height="10.839" stroke="none"/><rect x="0.5" y="0.5" width="32.95" height="9.839" fill="none"/></g><rect id="Rectangle_851" data-name="Rectangle 851" width="23.34" height="2.168" transform="translate(5.305 4.336)" fill="#566779" opacity="0.2"/></g><g id="Group_5776" data-name="Group 5776" transform="translate(4.244 8.885)"><rect id="Rectangle_457" data-name="Rectangle 457" width="21.218" height="4.336" transform="translate(24.401 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236" data-name="Rectangle 1236" width="21.218" height="4.336" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385" data-name="Rectangle 385" width="53.979" height="5.983" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5784" data-name="Group 5784" transform="translate(28 99.407)"><g id="Group_5777-2" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-2" data-name="Path 304" d="M0,0H63.579V36.116H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_2" data-name="picture (1)" transform="translate(19.866 8.365)" opacity="0.4"><path id="Path_198-2" data-name="Path 198" d="M82.444,115.074A3.074,3.074,0,1,0,85.518,112,3.074,3.074,0,0,0,82.444,115.074Zm6.148,15.37H64l6.148-16.395,8.2,10.247,4.1-3.074Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-2" data-name="Group 5780" transform="translate(0 36.7)"><path id="Path_23077-2" data-name="Path 23077" d="M0,43.409H63.654V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-2" data-name="Group 5779" transform="translate(4.837 5.805)"><g id="Group_5778-2" data-name="Group 5778" transform="translate(9.548 19.025)"><g id="Rectangle_850-2" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="33.95" height="10.839" stroke="none"/><rect x="0.5" y="0.5" width="32.95" height="9.839" fill="none"/></g><rect id="Rectangle_851-2" data-name="Rectangle 851" width="23.34" height="2.168" transform="translate(5.305 4.336)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-2" data-name="Group 5776" transform="translate(4.244 8.885)"><rect id="Rectangle_457-2" data-name="Rectangle 457" width="21.218" height="4.336" transform="translate(24.401 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-2" data-name="Rectangle 1236" width="21.218" height="4.336" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-2" data-name="Rectangle 385" width="53.979" height="5.983" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5787" data-name="Group 5787" transform="translate(28 189.892)"><g id="Group_5777-3" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-3" data-name="Path 304" d="M0,0H63.579V36.116H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_3" data-name="picture (1)" transform="translate(19.866 8.365)" opacity="0.4"><path id="Path_198-3" data-name="Path 198" d="M82.444,115.074A3.074,3.074,0,1,0,85.518,112,3.074,3.074,0,0,0,82.444,115.074Zm6.148,15.37H64l6.148-16.395,8.2,10.247,4.1-3.074Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-3" data-name="Group 5780" transform="translate(0 36.7)"><path id="Path_23077-3" data-name="Path 23077" d="M0,43.409H63.654V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-3" data-name="Group 5779" transform="translate(4.837 5.805)"><g id="Group_5778-3" data-name="Group 5778" transform="translate(9.548 19.025)"><g id="Rectangle_850-3" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="33.95" height="10.839" stroke="none"/><rect x="0.5" y="0.5" width="32.95" height="9.839" fill="none"/></g><rect id="Rectangle_851-3" data-name="Rectangle 851" width="23.34" height="2.168" transform="translate(5.305 4.336)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-3" data-name="Group 5776" transform="translate(4.244 8.885)"><rect id="Rectangle_457-3" data-name="Rectangle 457" width="21.218" height="4.336" transform="translate(24.401 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-3" data-name="Rectangle 1236" width="21.218" height="4.336" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-3" data-name="Rectangle 385" width="53.979" height="5.983" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5782" data-name="Group 5782" transform="translate(103.404 10)"><g id="Group_5777-4" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-4" data-name="Path 304" d="M0,0H63.579V36.116H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_4" data-name="picture (1)" transform="translate(19.866 8.365)" opacity="0.4"><path id="Path_198-4" data-name="Path 198" d="M82.444,115.074A3.074,3.074,0,1,0,85.518,112,3.074,3.074,0,0,0,82.444,115.074Zm6.148,15.37H64l6.148-16.395,8.2,10.247,4.1-3.074Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-4" data-name="Group 5780" transform="translate(0 36.7)"><path id="Path_23077-4" data-name="Path 23077" d="M0,43.409H63.654V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-4" data-name="Group 5779" transform="translate(4.837 5.805)"><g id="Group_5778-4" data-name="Group 5778" transform="translate(9.548 19.025)"><g id="Rectangle_850-4" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="33.95" height="10.839" stroke="none"/><rect x="0.5" y="0.5" width="32.95" height="9.839" fill="none"/></g><rect id="Rectangle_851-4" data-name="Rectangle 851" width="23.34" height="2.168" transform="translate(5.305 4.336)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-4" data-name="Group 5776" transform="translate(4.244 8.885)"><rect id="Rectangle_457-4" data-name="Rectangle 457" width="21.218" height="4.336" transform="translate(24.401 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-4" data-name="Rectangle 1236" width="21.218" height="4.336" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-4" data-name="Rectangle 385" width="53.979" height="5.983" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5785" data-name="Group 5785" transform="translate(103.404 99.407)"><g id="Group_5777-5" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-5" data-name="Path 304" d="M0,0H63.579V36.116H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_5" data-name="picture (1)" transform="translate(19.866 8.365)" opacity="0.4"><path id="Path_198-5" data-name="Path 198" d="M82.444,115.074A3.074,3.074,0,1,0,85.518,112,3.074,3.074,0,0,0,82.444,115.074Zm6.148,15.37H64l6.148-16.395,8.2,10.247,4.1-3.074Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-5" data-name="Group 5780" transform="translate(0 36.7)"><path id="Path_23077-5" data-name="Path 23077" d="M0,43.409H63.654V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-5" data-name="Group 5779" transform="translate(4.837 5.805)"><g id="Group_5778-5" data-name="Group 5778" transform="translate(9.548 19.025)"><g id="Rectangle_850-5" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="33.95" height="10.839" stroke="none"/><rect x="0.5" y="0.5" width="32.95" height="9.839" fill="none"/></g><rect id="Rectangle_851-5" data-name="Rectangle 851" width="23.34" height="2.168" transform="translate(5.305 4.336)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-5" data-name="Group 5776" transform="translate(4.244 8.885)"><rect id="Rectangle_457-5" data-name="Rectangle 457" width="21.218" height="4.336" transform="translate(24.401 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-5" data-name="Rectangle 1236" width="21.218" height="4.336" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-5" data-name="Rectangle 385" width="53.979" height="5.983" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5789" data-name="Group 5789" transform="translate(103.404 189.892)"><g id="Group_5777-6" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-6" data-name="Path 304" d="M0,0H63.579V36.116H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_6" data-name="picture (1)" transform="translate(19.866 8.365)" opacity="0.4"><path id="Path_198-6" data-name="Path 198" d="M82.444,115.074A3.074,3.074,0,1,0,85.518,112,3.074,3.074,0,0,0,82.444,115.074Zm6.148,15.37H64l6.148-16.395,8.2,10.247,4.1-3.074Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-6" data-name="Group 5780" transform="translate(0 36.7)"><path id="Path_23077-6" data-name="Path 23077" d="M0,43.409H63.654V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-6" data-name="Group 5779" transform="translate(4.837 5.805)"><g id="Group_5778-6" data-name="Group 5778" transform="translate(9.548 19.025)"><g id="Rectangle_850-6" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="33.95" height="10.839" stroke="none"/><rect x="0.5" y="0.5" width="32.95" height="9.839" fill="none"/></g><rect id="Rectangle_851-6" data-name="Rectangle 851" width="23.34" height="2.168" transform="translate(5.305 4.336)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-6" data-name="Group 5776" transform="translate(4.244 8.885)"><rect id="Rectangle_457-6" data-name="Rectangle 457" width="21.218" height="4.336" transform="translate(24.401 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-6" data-name="Rectangle 1236" width="21.218" height="4.336" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-6" data-name="Rectangle 385" width="53.979" height="5.983" fill="#566779" opacity="0.3"/></g></g></g></g><path id="Path_264" data-name="Path 264" d="M0,0H60V260H0Z" transform="translate(187.145 15)" fill="#566779" opacity="0.1"/></g></svg>',
                            'title' => __('Right Sidebar', 'rishi'),
                        ],

                        'left-sidebar' => [
                            'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="102" height="102" viewBox="0 0 275 275"><defs><clipPath id="clip-_2"><rect width="275" height="275"/></clipPath></defs><g id="_2" data-name="2" clip-path="url(#clip-_2)"><rect width="275" height="275" /><g id="Group_5807" data-name="Group 5807"><g id="Group_5800" data-name="Group 5800" transform="translate(80.002 5)"><g id="Group_5781" data-name="Group 5781" transform="translate(28 10)"><g id="Group_5777" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304" data-name="Path 304" d="M0,0H63.579V36.116H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_" data-name="picture (1)" transform="translate(19.866 8.365)" opacity="0.4"><path id="Path_198" data-name="Path 198" d="M82.444,115.074A3.074,3.074,0,1,0,85.518,112,3.074,3.074,0,0,0,82.444,115.074Zm6.148,15.37H64l6.148-16.395,8.2,10.247,4.1-3.074Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780" data-name="Group 5780" transform="translate(0 36.7)"><path id="Path_23077" data-name="Path 23077" d="M0,43.409H63.654V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779" data-name="Group 5779" transform="translate(4.837 5.805)"><g id="Group_5778" data-name="Group 5778" transform="translate(9.548 19.025)"><g id="Rectangle_850" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="33.95" height="10.839" stroke="none"/><rect x="0.5" y="0.5" width="32.95" height="9.839" fill="none"/></g><rect id="Rectangle_851" data-name="Rectangle 851" width="23.34" height="2.168" transform="translate(5.305 4.336)" fill="#566779" opacity="0.2"/></g><g id="Group_5776" data-name="Group 5776" transform="translate(4.244 8.885)"><rect id="Rectangle_457" data-name="Rectangle 457" width="21.218" height="4.336" transform="translate(24.401 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236" data-name="Rectangle 1236" width="21.218" height="4.336" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385" data-name="Rectangle 385" width="53.979" height="5.983" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5784" data-name="Group 5784" transform="translate(28 99.407)"><g id="Group_5777-2" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-2" data-name="Path 304" d="M0,0H63.579V36.116H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_2" data-name="picture (1)" transform="translate(19.866 8.365)" opacity="0.4"><path id="Path_198-2" data-name="Path 198" d="M82.444,115.074A3.074,3.074,0,1,0,85.518,112,3.074,3.074,0,0,0,82.444,115.074Zm6.148,15.37H64l6.148-16.395,8.2,10.247,4.1-3.074Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-2" data-name="Group 5780" transform="translate(0 36.7)"><path id="Path_23077-2" data-name="Path 23077" d="M0,43.409H63.654V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-2" data-name="Group 5779" transform="translate(4.837 5.805)"><g id="Group_5778-2" data-name="Group 5778" transform="translate(9.548 19.025)"><g id="Rectangle_850-2" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="33.95" height="10.839" stroke="none"/><rect x="0.5" y="0.5" width="32.95" height="9.839" fill="none"/></g><rect id="Rectangle_851-2" data-name="Rectangle 851" width="23.34" height="2.168" transform="translate(5.305 4.336)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-2" data-name="Group 5776" transform="translate(4.244 8.885)"><rect id="Rectangle_457-2" data-name="Rectangle 457" width="21.218" height="4.336" transform="translate(24.401 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-2" data-name="Rectangle 1236" width="21.218" height="4.336" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-2" data-name="Rectangle 385" width="53.979" height="5.983" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5787" data-name="Group 5787" transform="translate(28 189.892)"><g id="Group_5777-3" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-3" data-name="Path 304" d="M0,0H63.579V36.116H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_3" data-name="picture (1)" transform="translate(19.866 8.365)" opacity="0.4"><path id="Path_198-3" data-name="Path 198" d="M82.444,115.074A3.074,3.074,0,1,0,85.518,112,3.074,3.074,0,0,0,82.444,115.074Zm6.148,15.37H64l6.148-16.395,8.2,10.247,4.1-3.074Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-3" data-name="Group 5780" transform="translate(0 36.7)"><path id="Path_23077-3" data-name="Path 23077" d="M0,43.409H63.654V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-3" data-name="Group 5779" transform="translate(4.837 5.805)"><g id="Group_5778-3" data-name="Group 5778" transform="translate(9.548 19.025)"><g id="Rectangle_850-3" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="33.95" height="10.839" stroke="none"/><rect x="0.5" y="0.5" width="32.95" height="9.839" fill="none"/></g><rect id="Rectangle_851-3" data-name="Rectangle 851" width="23.34" height="2.168" transform="translate(5.305 4.336)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-3" data-name="Group 5776" transform="translate(4.244 8.885)"><rect id="Rectangle_457-3" data-name="Rectangle 457" width="21.218" height="4.336" transform="translate(24.401 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-3" data-name="Rectangle 1236" width="21.218" height="4.336" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-3" data-name="Rectangle 385" width="53.979" height="5.983" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5782" data-name="Group 5782" transform="translate(103.404 10)"><g id="Group_5777-4" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-4" data-name="Path 304" d="M0,0H63.579V36.116H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_4" data-name="picture (1)" transform="translate(19.866 8.365)" opacity="0.4"><path id="Path_198-4" data-name="Path 198" d="M82.444,115.074A3.074,3.074,0,1,0,85.518,112,3.074,3.074,0,0,0,82.444,115.074Zm6.148,15.37H64l6.148-16.395,8.2,10.247,4.1-3.074Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-4" data-name="Group 5780" transform="translate(0 36.7)"><path id="Path_23077-4" data-name="Path 23077" d="M0,43.409H63.654V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-4" data-name="Group 5779" transform="translate(4.837 5.805)"><g id="Group_5778-4" data-name="Group 5778" transform="translate(9.548 19.025)"><g id="Rectangle_850-4" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="33.95" height="10.839" stroke="none"/><rect x="0.5" y="0.5" width="32.95" height="9.839" fill="none"/></g><rect id="Rectangle_851-4" data-name="Rectangle 851" width="23.34" height="2.168" transform="translate(5.305 4.336)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-4" data-name="Group 5776" transform="translate(4.244 8.885)"><rect id="Rectangle_457-4" data-name="Rectangle 457" width="21.218" height="4.336" transform="translate(24.401 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-4" data-name="Rectangle 1236" width="21.218" height="4.336" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-4" data-name="Rectangle 385" width="53.979" height="5.983" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5785" data-name="Group 5785" transform="translate(103.404 99.407)"><g id="Group_5777-5" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-5" data-name="Path 304" d="M0,0H63.579V36.116H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_5" data-name="picture (1)" transform="translate(19.866 8.365)" opacity="0.4"><path id="Path_198-5" data-name="Path 198" d="M82.444,115.074A3.074,3.074,0,1,0,85.518,112,3.074,3.074,0,0,0,82.444,115.074Zm6.148,15.37H64l6.148-16.395,8.2,10.247,4.1-3.074Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-5" data-name="Group 5780" transform="translate(0 36.7)"><path id="Path_23077-5" data-name="Path 23077" d="M0,43.409H63.654V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-5" data-name="Group 5779" transform="translate(4.837 5.805)"><g id="Group_5778-5" data-name="Group 5778" transform="translate(9.548 19.025)"><g id="Rectangle_850-5" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="33.95" height="10.839" stroke="none"/><rect x="0.5" y="0.5" width="32.95" height="9.839" fill="none"/></g><rect id="Rectangle_851-5" data-name="Rectangle 851" width="23.34" height="2.168" transform="translate(5.305 4.336)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-5" data-name="Group 5776" transform="translate(4.244 8.885)"><rect id="Rectangle_457-5" data-name="Rectangle 457" width="21.218" height="4.336" transform="translate(24.401 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-5" data-name="Rectangle 1236" width="21.218" height="4.336" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-5" data-name="Rectangle 385" width="53.979" height="5.983" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5789" data-name="Group 5789" transform="translate(103.404 189.892)"><g id="Group_5777-6" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-6" data-name="Path 304" d="M0,0H63.579V36.116H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_6" data-name="picture (1)" transform="translate(19.866 8.365)" opacity="0.4"><path id="Path_198-6" data-name="Path 198" d="M82.444,115.074A3.074,3.074,0,1,0,85.518,112,3.074,3.074,0,0,0,82.444,115.074Zm6.148,15.37H64l6.148-16.395,8.2,10.247,4.1-3.074Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-6" data-name="Group 5780" transform="translate(0 36.7)"><path id="Path_23077-6" data-name="Path 23077" d="M0,43.409H63.654V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-6" data-name="Group 5779" transform="translate(4.837 5.805)"><g id="Group_5778-6" data-name="Group 5778" transform="translate(9.548 19.025)"><g id="Rectangle_850-6" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="33.95" height="10.839" stroke="none"/><rect x="0.5" y="0.5" width="32.95" height="9.839" fill="none"/></g><rect id="Rectangle_851-6" data-name="Rectangle 851" width="23.34" height="2.168" transform="translate(5.305 4.336)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-6" data-name="Group 5776" transform="translate(4.244 8.885)"><rect id="Rectangle_457-6" data-name="Rectangle 457" width="21.218" height="4.336" transform="translate(24.401 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-6" data-name="Rectangle 1236" width="21.218" height="4.336" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-6" data-name="Rectangle 385" width="53.979" height="5.983" fill="#566779" opacity="0.3"/></g></g></g></g><path id="Path_264" data-name="Path 264" d="M0,0H60V260H0Z" transform="translate(28 15)" fill="#566779" opacity="0.1"/></g></g></svg>',
                            'title' => __('Left Sidebar', 'rishi'),
                        ],

                        'no-sidebar' => [
                            'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="102" height="102" viewBox="0 0 275 275"><defs><clipPath id="clip-_3"><rect width="275" height="275"/></clipPath></defs><g id="_3" data-name="3" clip-path="url(#clip-_3)"><rect width="275" height="275"/><g id="Group_5800" data-name="Group 5800" transform="translate(0 12)"><g id="Group_5781" data-name="Group 5781" transform="translate(28 10)"><g id="Group_5777" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304" data-name="Path 304" d="M0,0H59.023V33.528H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_" data-name="picture (1)" transform="translate(18.442 7.765)" opacity="0.4"><path id="Path_198" data-name="Path 198" d="M81.122,114.854A2.854,2.854,0,1,0,83.976,112,2.854,2.854,0,0,0,81.122,114.854Zm5.707,14.268H64l5.707-15.22,7.61,9.512,3.8-2.854Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780" data-name="Group 5780" transform="translate(0 34.07)"><path id="Path_23077" data-name="Path 23077" d="M0,40.3H59.092V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779" data-name="Group 5779" transform="translate(4.491 5.389)"><g id="Group_5778" data-name="Group 5778" transform="translate(8.864 17.662)"><g id="Rectangle_850" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="31.517" height="10.062" stroke="none"/><rect x="0.5" y="0.5" width="30.517" height="9.062" fill="none"/></g><rect id="Rectangle_851" data-name="Rectangle 851" width="21.668" height="2.012" transform="translate(4.924 4.025)" fill="#566779" opacity="0.2"/></g><g id="Group_5776" data-name="Group 5776" transform="translate(3.94 8.248)"><rect id="Rectangle_457" data-name="Rectangle 457" width="19.698" height="4.025" transform="translate(22.653 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236" data-name="Rectangle 1236" width="19.698" height="4.025" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385" data-name="Rectangle 385" width="50.111" height="5.554" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5784" data-name="Group 5784" transform="translate(28 93)"><g id="Group_5777-2" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-2" data-name="Path 304" d="M0,0H59.023V33.528H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_2" data-name="picture (1)" transform="translate(18.442 7.765)" opacity="0.4"><path id="Path_198-2" data-name="Path 198" d="M81.122,114.854A2.854,2.854,0,1,0,83.976,112,2.854,2.854,0,0,0,81.122,114.854Zm5.707,14.268H64l5.707-15.22,7.61,9.512,3.8-2.854Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-2" data-name="Group 5780" transform="translate(0 34.07)"><path id="Path_23077-2" data-name="Path 23077" d="M0,40.3H59.092V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-2" data-name="Group 5779" transform="translate(4.491 5.389)"><g id="Group_5778-2" data-name="Group 5778" transform="translate(8.864 17.662)"><g id="Rectangle_850-2" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="31.517" height="10.062" stroke="none"/><rect x="0.5" y="0.5" width="30.517" height="9.062" fill="none"/></g><rect id="Rectangle_851-2" data-name="Rectangle 851" width="21.668" height="2.012" transform="translate(4.924 4.025)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-2" data-name="Group 5776" transform="translate(3.94 8.248)"><rect id="Rectangle_457-2" data-name="Rectangle 457" width="19.698" height="4.025" transform="translate(22.653 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-2" data-name="Rectangle 1236" width="19.698" height="4.025" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-2" data-name="Rectangle 385" width="50.111" height="5.554" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5787" data-name="Group 5787" transform="translate(28 177)"><g id="Group_5777-3" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-3" data-name="Path 304" d="M0,0H59.023V33.528H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_3" data-name="picture (1)" transform="translate(18.442 7.765)" opacity="0.4"><path id="Path_198-3" data-name="Path 198" d="M81.122,114.854A2.854,2.854,0,1,0,83.976,112,2.854,2.854,0,0,0,81.122,114.854Zm5.707,14.268H64l5.707-15.22,7.61,9.512,3.8-2.854Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-3" data-name="Group 5780" transform="translate(0 34.07)"><path id="Path_23077-3" data-name="Path 23077" d="M0,40.3H59.092V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-3" data-name="Group 5779" transform="translate(4.491 5.389)"><g id="Group_5778-3" data-name="Group 5778" transform="translate(8.864 17.662)"><g id="Rectangle_850-3" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="31.517" height="10.062" stroke="none"/><rect x="0.5" y="0.5" width="30.517" height="9.062" fill="none"/></g><rect id="Rectangle_851-3" data-name="Rectangle 851" width="21.668" height="2.012" transform="translate(4.924 4.025)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-3" data-name="Group 5776" transform="translate(3.94 8.248)"><rect id="Rectangle_457-3" data-name="Rectangle 457" width="19.698" height="4.025" transform="translate(22.653 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-3" data-name="Rectangle 1236" width="19.698" height="4.025" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-3" data-name="Rectangle 385" width="50.111" height="5.554" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5782" data-name="Group 5782" transform="translate(108 10)"><g id="Group_5777-4" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-4" data-name="Path 304" d="M0,0H59.023V33.528H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_4" data-name="picture (1)" transform="translate(18.442 7.765)" opacity="0.4"><path id="Path_198-4" data-name="Path 198" d="M81.122,114.854A2.854,2.854,0,1,0,83.976,112,2.854,2.854,0,0,0,81.122,114.854Zm5.707,14.268H64l5.707-15.22,7.61,9.512,3.8-2.854Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-4" data-name="Group 5780" transform="translate(0 34.07)"><path id="Path_23077-4" data-name="Path 23077" d="M0,40.3H59.092V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-4" data-name="Group 5779" transform="translate(4.491 5.389)"><g id="Group_5778-4" data-name="Group 5778" transform="translate(8.864 17.662)"><g id="Rectangle_850-4" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="31.517" height="10.062" stroke="none"/><rect x="0.5" y="0.5" width="30.517" height="9.062" fill="none"/></g><rect id="Rectangle_851-4" data-name="Rectangle 851" width="21.668" height="2.012" transform="translate(4.924 4.025)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-4" data-name="Group 5776" transform="translate(3.94 8.248)"><rect id="Rectangle_457-4" data-name="Rectangle 457" width="19.698" height="4.025" transform="translate(22.653 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-4" data-name="Rectangle 1236" width="19.698" height="4.025" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-4" data-name="Rectangle 385" width="50.111" height="5.554" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5785" data-name="Group 5785" transform="translate(108 93)"><g id="Group_5777-5" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-5" data-name="Path 304" d="M0,0H59.023V33.528H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_5" data-name="picture (1)" transform="translate(18.442 7.765)" opacity="0.4"><path id="Path_198-5" data-name="Path 198" d="M81.122,114.854A2.854,2.854,0,1,0,83.976,112,2.854,2.854,0,0,0,81.122,114.854Zm5.707,14.268H64l5.707-15.22,7.61,9.512,3.8-2.854Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-5" data-name="Group 5780" transform="translate(0 34.07)"><path id="Path_23077-5" data-name="Path 23077" d="M0,40.3H59.092V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-5" data-name="Group 5779" transform="translate(4.491 5.389)"><g id="Group_5778-5" data-name="Group 5778" transform="translate(8.864 17.662)"><g id="Rectangle_850-5" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="31.517" height="10.062" stroke="none"/><rect x="0.5" y="0.5" width="30.517" height="9.062" fill="none"/></g><rect id="Rectangle_851-5" data-name="Rectangle 851" width="21.668" height="2.012" transform="translate(4.924 4.025)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-5" data-name="Group 5776" transform="translate(3.94 8.248)"><rect id="Rectangle_457-5" data-name="Rectangle 457" width="19.698" height="4.025" transform="translate(22.653 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-5" data-name="Rectangle 1236" width="19.698" height="4.025" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-5" data-name="Rectangle 385" width="50.111" height="5.554" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5789" data-name="Group 5789" transform="translate(108 177)"><g id="Group_5777-6" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-6" data-name="Path 304" d="M0,0H59.023V33.528H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_6" data-name="picture (1)" transform="translate(18.442 7.765)" opacity="0.4"><path id="Path_198-6" data-name="Path 198" d="M81.122,114.854A2.854,2.854,0,1,0,83.976,112,2.854,2.854,0,0,0,81.122,114.854Zm5.707,14.268H64l5.707-15.22,7.61,9.512,3.8-2.854Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-6" data-name="Group 5780" transform="translate(0 34.07)"><path id="Path_23077-6" data-name="Path 23077" d="M0,40.3H59.092V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-6" data-name="Group 5779" transform="translate(4.491 5.389)"><g id="Group_5778-6" data-name="Group 5778" transform="translate(8.864 17.662)"><g id="Rectangle_850-6" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="31.517" height="10.062" stroke="none"/><rect x="0.5" y="0.5" width="30.517" height="9.062" fill="none"/></g><rect id="Rectangle_851-6" data-name="Rectangle 851" width="21.668" height="2.012" transform="translate(4.924 4.025)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-6" data-name="Group 5776" transform="translate(3.94 8.248)"><rect id="Rectangle_457-6" data-name="Rectangle 457" width="19.698" height="4.025" transform="translate(22.653 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-6" data-name="Rectangle 1236" width="19.698" height="4.025" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-6" data-name="Rectangle 385" width="50.111" height="5.554" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5783" data-name="Group 5783" transform="translate(188 10)"><g id="Group_5777-7" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-7" data-name="Path 304" d="M0,0H59.023V33.528H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_7" data-name="picture (1)" transform="translate(18.442 7.765)" opacity="0.4"><path id="Path_198-7" data-name="Path 198" d="M81.122,114.854A2.854,2.854,0,1,0,83.976,112,2.854,2.854,0,0,0,81.122,114.854Zm5.707,14.268H64l5.707-15.22,7.61,9.512,3.8-2.854Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-7" data-name="Group 5780" transform="translate(0 34.07)"><path id="Path_23077-7" data-name="Path 23077" d="M0,40.3H59.092V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-7" data-name="Group 5779" transform="translate(4.491 5.389)"><g id="Group_5778-7" data-name="Group 5778" transform="translate(8.864 17.662)"><g id="Rectangle_850-7" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="31.517" height="10.062" stroke="none"/><rect x="0.5" y="0.5" width="30.517" height="9.062" fill="none"/></g><rect id="Rectangle_851-7" data-name="Rectangle 851" width="21.668" height="2.012" transform="translate(4.924 4.025)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-7" data-name="Group 5776" transform="translate(3.94 8.248)"><rect id="Rectangle_457-7" data-name="Rectangle 457" width="19.698" height="4.025" transform="translate(22.653 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-7" data-name="Rectangle 1236" width="19.698" height="4.025" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-7" data-name="Rectangle 385" width="50.111" height="5.554" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5786" data-name="Group 5786" transform="translate(188 93)"><g id="Group_5777-8" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-8" data-name="Path 304" d="M0,0H59.023V33.528H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_8" data-name="picture (1)" transform="translate(18.442 7.765)" opacity="0.4"><path id="Path_198-8" data-name="Path 198" d="M81.122,114.854A2.854,2.854,0,1,0,83.976,112,2.854,2.854,0,0,0,81.122,114.854Zm5.707,14.268H64l5.707-15.22,7.61,9.512,3.8-2.854Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-8" data-name="Group 5780" transform="translate(0 34.07)"><path id="Path_23077-8" data-name="Path 23077" d="M0,40.3H59.092V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-8" data-name="Group 5779" transform="translate(4.491 5.389)"><g id="Group_5778-8" data-name="Group 5778" transform="translate(8.864 17.662)"><g id="Rectangle_850-8" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="31.517" height="10.062" stroke="none"/><rect x="0.5" y="0.5" width="30.517" height="9.062" fill="none"/></g><rect id="Rectangle_851-8" data-name="Rectangle 851" width="21.668" height="2.012" transform="translate(4.924 4.025)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-8" data-name="Group 5776" transform="translate(3.94 8.248)"><rect id="Rectangle_457-8" data-name="Rectangle 457" width="19.698" height="4.025" transform="translate(22.653 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-8" data-name="Rectangle 1236" width="19.698" height="4.025" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-8" data-name="Rectangle 385" width="50.111" height="5.554" fill="#566779" opacity="0.3"/></g></g></g><g id="Group_5788" data-name="Group 5788" transform="translate(188 177)"><g id="Group_5777-9" data-name="Group 5777" transform="translate(0 0)"><path id="Path_304-9" data-name="Path 304" d="M0,0H59.023V33.528H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_9" data-name="picture (1)" transform="translate(18.442 7.765)" opacity="0.4"><path id="Path_198-9" data-name="Path 198" d="M81.122,114.854A2.854,2.854,0,1,0,83.976,112,2.854,2.854,0,0,0,81.122,114.854Zm5.707,14.268H64l5.707-15.22,7.61,9.512,3.8-2.854Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5780-9" data-name="Group 5780" transform="translate(0 34.07)"><path id="Path_23077-9" data-name="Path 23077" d="M0,40.3H59.092V0H0Z" transform="translate(0 0)" fill="#fff"/><g id="Group_5779-9" data-name="Group 5779" transform="translate(4.491 5.389)"><g id="Group_5778-9" data-name="Group 5778" transform="translate(8.864 17.662)"><g id="Rectangle_850-9" data-name="Rectangle 850" fill="#fff" stroke="#566779" stroke-width="1" opacity="0.3"><rect width="31.517" height="10.062" stroke="none"/><rect x="0.5" y="0.5" width="30.517" height="9.062" fill="none"/></g><rect id="Rectangle_851-9" data-name="Rectangle 851" width="21.668" height="2.012" transform="translate(4.924 4.025)" fill="#566779" opacity="0.2"/></g><g id="Group_5776-9" data-name="Group 5776" transform="translate(3.94 8.248)"><rect id="Rectangle_457-9" data-name="Rectangle 457" width="19.698" height="4.025" transform="translate(22.653 0)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1236-9" data-name="Rectangle 1236" width="19.698" height="4.025" transform="translate(0 0)" fill="#566779" opacity="0.2"/></g><rect id="Rectangle_385-9" data-name="Rectangle 385" width="50.111" height="5.554" fill="#566779" opacity="0.3"/></g></g></g></g></g></svg>',
                            'title' => __('Fullwidth', 'rishi'),
                        ],
                    ],
                ],
                'woocommerce_layout' => [
                    'label'   => __('Shop Page Layout', 'rishi'),
                    'type'    => 'rt-select',
                    'value'   => 'boxed',
                    'view'    => 'text',
                    'design'  => 'inline',
                    'divider' => 'top',
                    'choices' => rishi__cb_customizer_ordered_keys([
                        'boxed'                => __('Boxed', 'rishi'),
                        'content_boxed'        => __('Content Boxed', 'rishi'),
                        'full_width_contained' => __('Unboxed', 'rishi'),
                    ]),
                    'desc' => __('Choose page layout.', 'rishi'),
                ],
                $wooprefix . 'layout_streched_ed' => [
                    'label'   => __('Stretch Layout', 'rishi'),
                    'desc'    => __('This setting stretches the container width.', 'rishi'),
                    'type'    => 'rara-switch',
                    'value'   => 'no',
                    'divider' => 'top',
                ],
                'woo_sales_badge_panel' => [
                    'label' => __('Sales Badge Options', 'rishi'),
                    'type' => 'rt-panel',
                    'value' => 'yes',
                    'inner-options' => [
                        rishi__cb_customizer_rand_md5() => [
                            'title' => __( 'General', 'rishi' ),
                            'type' => 'tab',
                            'options' => [
                                'has_sale_badge' => [
                                    'label' => __( 'Sale Badge', 'rishi' ),
                                    'type' => 'rara-switch',
                                    'value' => 'yes',
                                ],

                                rishi__cb_customizer_rand_md5() => [
                                    'type'      => 'rt-condition',
                                    'condition' => ['has_sale_badge' => 'yes'],
                                    'options'   => [
                                        'sales_badge_title' => [
                                            'label' => __( 'Label', 'rishi' ),
                                            'type'   => 'text',
                                            'design' => 'block',
                                            'value' => __('SALE!', 'rishi'),
                                            'sync' => [
                                                'selector' => '.woocommerce .onsale',
                                                'render' => function() { echo rishi_sale_badge_text(); }
                                            ],
                                        ],
                                    ],
                                ],

                                'shop_cards_sales_badge_design' => [
                                    'label'   => __('Sale Badge Design', 'rishi'),
                                    'type'    => 'rt-image-picker',
                                    'value'   => 'circle',
                                    'view'    => 'text',
                                    'setting' => ['transport' => 'postMessage'],
                                    'attr'    => ['data-columns' => '4'],
                                    'choices' => [
                                        'circle' => [
                                            'src'   => rishi__cb_customizer_image_picker_file('circle'),
                                            'title' => __('Circle', 'rishi'),
                                        ],
                                        'square' => [
                                            'src'   => rishi__cb_customizer_image_picker_file('square'),
                                            'title' => __('Rectangle', 'rishi'),
                                        ],                                    
                                        'oval' => [
                                            'src'   => rishi__cb_customizer_image_picker_file('oval'),
                                            'title' => __('Oval', 'rishi'),
                                        ],
                                        'semi-oval' => [
                                            'src'   => rishi__cb_customizer_image_picker_file('semi-oval'),
                                            'title' => __('Semi Oval', 'rishi'),
                                        ],
                                    ],
                                ],
                            ]
                        ],
                        rishi__cb_customizer_rand_md5() => [
                            'title' => __( 'Design', 'rishi' ),
                            'type' => 'tab',
                            'options' => [
                                'salesBagdgeColor' => [
                                    'label' => __( 'Sales Badge Color', 'rishi' ),
                                    'type'  => 'rt-color-picker',
                                    'design' => 'inline',
                                    'setting' => [ 'transport' => 'postMessage' ],
                                    'value' => [
                                        'default' => [
                                            'color' => 'var(--paletteColor5)',
                                        ],
                
                                        'background' => [
                                            'color' => '#E71919',
                                        ],
                                    ],
                
                                    'pickers' => [
                                        [
                                            'title' => __( 'Text Color', 'rishi' ),
                                            'id' => 'default',
                                        ],
                
                                        [
                                            'title' => __( 'Background', 'rishi' ),
                                            'id' => 'background',
                                        ],
                                    ],
                                ],
                            ]
                        ]
                    ]
                ]
            ],
        ],
        rishi__cb_customizer_rand_md5() => [
          'title'   => __('Design', 'rishi'),
          'type'    => 'tab',
          'options' => [

                rishi__cb_customizer_rand_md5() => [
                    'type' => 'rt-condition',
                    'condition' => [ 'page_layout' => '!full_width_contained' ],
                    'options' => [
                        $wooprefix . 'content_background' => [
                            'label' => __( 'Content Area Background', 'rishi' ),
                            'type' => 'rt-background',
                            'design' => 'block:right',
                            'responsive' => true,
                            'sync' => 'live',
                            'value' => rishi__cb_customizer_background_default_value([
                                'backgroundColor' => [
                                    'default' => [
                                        'color' => 'var(--paletteColor5)',
                                    ],
                                ],
                            ])
                        ],

                        $wooprefix . 'content_boxed_shadow' => [
                            'label'      => __( 'Content Area Shadow', 'rishi' ),
                            'type'       => 'rt-box-shadow',
                            'responsive' => true,
                            'divider'    => 'top',
                            'sync' => 'live',
                            'value' => rishi__cb_customizer_box_shadow_value([
                                'enable' => false,
                                'h_offset' => 0,
                                'v_offset' => 12,
                                'blur' => 18,
                                'spread' => -6,
                                'inset' => false,
                                'color' => [
                                    'color' => 'rgba(34, 56, 101, 0.04)',
                                ],
                            ])
                        ],

                        $wooprefix . 'boxed_content_spacing' => [
                            'label' => __( 'Content Area Padding', 'rishi' ),
                            'type' => 'rt-spacing',
                            'divider' => 'top',
                            'value' =>[
                                'desktop' =>    rishi__cb_customizer_spacing_value([
                                    'linked' => true,
                                    'top'    => '40px',
                                    'left'   => '40px',
                                    'right'  => '40px',
                                    'bottom' => '40px',
                                ]),
                                'tablet' =>    rishi__cb_customizer_spacing_value([
                                    'linked' => true,
                                    'top'    => '15px',
                                    'left'   => '15px',
                                    'right'  => '15px',
                                    'bottom' => '15px',
                                ]),
                                'mobile' =>    rishi__cb_customizer_spacing_value([
                                    'linked' => true,
                                    'top'    => '15px',
                                    'left'   => '15px',
                                    'right'  => '15px',
                                    'bottom' => '15px',
                                ]),
                            ],
                            'responsive' => true,
                            'sync' => 'live',
                        ],

                        $wooprefix . 'content_boxed_radius' => [
                            'label' => __( 'Content Area Border Radius', 'rishi' ),
                            'type' => 'rt-spacing',
                            'divider' => 'top',
                            'value' => rishi__cb_customizer_spacing_value([
                                'linked' => true,
                                'top' => '3px',
                                'left' => '3px',
                                'right' => '3px',
                                'bottom' => '3px',
                            ]),
                            'responsive' => true,
                            'sync' => 'live',
                        ],

                        rishi__cb_customizer_rand_md5() => [
                            'type' => 'rt-title',
                            'label' => __( 'WooCommerce Button Settings', 'rishi' ),
                            'desc' => sprintf(
                                __( 'WooCommerce Button works for %1$sAdd to cart%2$s Button, %1$sCart Page%2$s Button, %1$sCheckout Page%2$s Buttons, %1$sMy account Page%2$s button and other %1$sMessage%2$s buttons', 'rishi' ),
                                '<b>',
                                '</b>'
                            ),
                        ],
                    ],
                ],
                $wooprefix . 'btn_text_color' => [
                    'label'           => __('Text Color', 'rishi'),
                    'type'            => 'rt-color-picker',
                    'skipEditPalette' => true,
                    'design'          => 'inline',
                    'setting'         => ['transport' => 'postMessage'],
                    'value'           => [
                        'default' => [
                            'color' => $colordefaults['woo_btn_text_color'],
                        ],
                    ],
                    'pickers' => [
                        [
                            'title' => __('Initial', 'rishi'),
                            'id'    => 'default',
                        ],
                    ],
                ],
                $wooprefix . 'btn_text_hover_color' => [
                    'label'           => __('Text Hover Color', 'rishi'),
                    'type'            => 'rt-color-picker',
                    'skipEditPalette' => true,
                    'design'          => 'inline',
                    'setting'         => ['transport' => 'postMessage'],
                    'value'           => [
                        'default' => [
                            'color' => $colordefaults['woo_btn_text_hover_color'],
                        ],
                    ],
                    'pickers' => [
                        [
                            'title' => __('Initial', 'rishi'),
                            'id'    => 'default',
                        ],
                    ],
                ],
                $wooprefix . 'btn_bg_color' => [
                    'label'           => __('Background Color', 'rishi'),
                    'type'            => 'rt-color-picker',
                    'skipEditPalette' => true,
                    'design'          => 'inline',
                    'setting'         => ['transport' => 'postMessage'],
                    'value'           => [
                        'default' => [
                            'color' => $colordefaults['woo_btn_bg_color'],
                        ],
                    ],
                    'pickers' => [
                        [
                            'title' => __('Initial', 'rishi'),
                            'id'    => 'default',
                        ],
                    ],
                ],
                $wooprefix . 'btn_bg_hover_color' => [
                    'label'           => __('Background Hover Color', 'rishi'),
                    'type'            => 'rt-color-picker',
                    'skipEditPalette' => true,
                    'design'          => 'inline',
                    'setting'         => ['transport' => 'postMessage'],
                    'value'           => [
                        'default' => [
                            'color' => $colordefaults['woo_btn_bg_hover_color'],
                        ],
                    ],
                    'pickers' => [
                        [
                            'title' => __('Initial', 'rishi'),
                            'id'    => 'default',
                        ],
                    ],
                ],
                $wooprefix . 'btn_border_color' => [
                    'label'           => __('Border Color', 'rishi'),
                    'type'            => 'rt-color-picker',
                    'skipEditPalette' => true,
                    'design'          => 'inline',
                    'setting'         => ['transport' => 'postMessage'],
                    'value'           => [
                        'default' => [
                            'color' => $colordefaults['woo_btn_border_color'],
                        ],
                    ],
                    'pickers' => [
                        [
                            'title' => __('Initial', 'rishi'),
                            'id'    => 'default',
                        ],
                    ],
                ],
                $wooprefix . 'btn_border_hover_color' => [
                    'label'           => __('Border Hover Color', 'rishi'),
                    'type'            => 'rt-color-picker',
                    'skipEditPalette' => true,
                    'design'          => 'inline',
                    'setting'         => ['transport' => 'postMessage'],
                    'value'           => [
                        'default' => [
                            'color' => $colordefaults['woo_btn_border_hover_color'],
                        ],
                    ],
                    'pickers' => [
                        [
                            'title' => __('Initial', 'rishi'),
                            'id'    => 'default',
                        ],
                    ],
                ],
            ],
        ],
    ]
);

$options = [
	'woo_general_section_options' => [
		'type'     => 'rt-options',
		'setting'  => [ 'transport' => 'postMessage' ],
		'priority' => 3,
        'inner-options' => $_inner_options        
    ],
];

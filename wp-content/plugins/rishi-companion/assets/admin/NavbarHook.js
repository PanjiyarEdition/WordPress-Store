import { addFilter } from "@wordpress/hooks"
import { Component } from "@wordpress/element";
import { __ } from "@wordpress/i18n";

const RishiCompanionTabs = [
    {
        id: 'extensions',
        label: __("Extensions", 'rishi-companion'),
    }
];

if ( ! RishiCompanionDashboard.plugin_data.hide_plugins_tab ) {
    RishiCompanionTabs.push({
        id: 'usefulplugin',
        label: __("Useful Plugins", 'rishi-companion'),
    })
}

if ( ! RishiCompanionDashboard.plugin_data.hide_changelogs_tab ) {
    RishiCompanionTabs.push({
        id: 'changelog',
        label: __("Changelog", 'rishi-companion'),
    })
}

class NavbarHooks extends Component {
    constructor(props) {
        super();
        addFilter('rishi_dashboard_tabs', 'NavbarHooks', function (tabs) {
            RishiCompanionTabs && RishiCompanionTabs.map((tab, index) => {
                tabs && tabs.push({
                    id: tab.id,
                    label: tab.label
                });
            });
            
            return tabs;
        });
    }

}
new NavbarHooks();

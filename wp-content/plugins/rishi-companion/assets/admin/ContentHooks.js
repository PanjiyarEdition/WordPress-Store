import { addFilter } from "@wordpress/hooks"
import { Component } from "@wordpress/element";

import Extensions from "./components/Extensions.js";
import Usefulplugin from "./components/Usefulplugin.js";
import Changelog from "./components/Changelog.js";

class ContentHooks extends Component {
    constructor(props) {
        super();
        addFilter('rishi_dashboard_components', 'ContentHooks', function (path) {
            
                return (
                <>                    
                    { "extensions" === path ? <Extensions /> : '' }
                    { "usefulplugin" === path && ! RishiCompanionDashboard.plugin_data.hide_plugins_tab ? <Usefulplugin /> : '' }
                    { "changelog" === path && ! RishiCompanionDashboard.plugin_data.hide_changelogs_tab ? <Changelog /> : '' }
                </> );

        });
    }

}
new ContentHooks();

import { __ } from "@wordpress/i18n";
import { applyFilters } from '@wordpress/hooks';

export const RishiTabs = applyFilters( 'rishi_dashboard_tabs', [
    {
        id: 'home',
        label: __("Home", 'rishi'),
    }
]);

if ( ! RishiDashboard.plugin_data.hide_starter_sites ) {
    RishiTabs.splice( 1, 0, {
        id: 'starter-sites',
        label: __("Starter Sites", 'rishi'),
    })
}

export default RishiTabs;
import { createBrowserHistory } from "history";
import { BrowserRouter as Router, useLocation } from 'react-router-dom';
import { applyFilters } from '@wordpress/hooks';
import Header from "./Header";
import Home from "./Home";
import Starter from "./Starter";
import Navbar from "./ui-components/Navbar";

const customHistory = createBrowserHistory();
function useQuery() {
    return new URLSearchParams(useLocation().search);
}

function Component({ path }) {
    
    if( "starter-sites" === path && ! RishiDashboard.plugin_data.hide_starter_sites ) {
        return <Starter />;
    } 
    
    if( "extensions" === path || "usefulplugin" === path || "changelog" === path ) {
        return applyFilters( 'rishi_dashboard_components', path );
    }

    return <Home />;

    
}

function QueryScreen() {
    let query = useQuery();
    return <Component path={query.get("tab")} />;
}


function Dashboard(props) {
    return (
        <Router history={customHistory}>
            <>
                <Header />
                <Navbar />
                <QueryScreen />
            </>
        </Router>
    );
}

export default Dashboard;

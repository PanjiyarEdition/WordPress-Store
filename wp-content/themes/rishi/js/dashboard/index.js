import { render } from "@wordpress/element";
import Dashboard from "./Dashboard";

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('rishi-dashboard')) {
        render(<Dashboard />, document.getElementById('rishi-dashboard'))
    }
})
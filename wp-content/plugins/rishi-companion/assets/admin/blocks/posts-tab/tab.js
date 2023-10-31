let nav_tabs_item = document.querySelectorAll('.rishi-posts-tabs .nav-tabs > li');
let post_content_item = document.querySelector('.rishi-posts-tabs .posts-tab-content .grid');

nav_tabs_item.forEach(tab => {
    tab.addEventListener('click', () => {

        //remove class
        let nav_tabs_item_1 = tab.closest('.rishi-posts-tabs').querySelectorAll('.nav-tabs > li');
        nav_tabs_item_1.forEach(tab => {
            tab.classList.remove('active');
        });

        //add class
        var tab_id = tab.getAttribute('data-tab');
        tab.classList.add("active");

       //get tab id
        let post_content_item_id = tab.closest('.rishi-posts-tabs').querySelector(`#${tab_id}`); 
        

        //remove class from tab content
        let post_content_item_1 = tab.closest('.rishi-posts-tabs').querySelectorAll('.posts-tab-content .grid');
        post_content_item_1.forEach(tabContent => {
            tabContent.classList.remove('active');
        });

        //add class to tab content
        post_content_item_id.classList.add('active');

    })
});
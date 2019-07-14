<?php
switch (get_row_layout()) {
    case 'keyvisual':
        get_template_part('template-parts/page/keyvisual');
        break;
    case 'testimonial_list':
        get_template_part('template-parts/page/testimonial_list');
        break;
    case 'event_list':
        get_template_part('template-parts/page/event_list');
        break;
    case 'features':
        get_template_part('template-parts/page/features');
        break;
    case 'post_list':
        get_template_part('template-parts/page/post_list');
        break;
    case 'portfolio':
        get_template_part('template-parts/page/portfolio');
        break;
}



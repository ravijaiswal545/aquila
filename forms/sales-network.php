<?php
/*
* Template Name: Sales network
*/
get_header();
?>
<!--./ Inner Page Container Start ./-->
<?php
global $post;
global $wpdb;
if (isset($_POST['term_taxonomy_id'])) {
    echo '<option value="">Select City</option>';
    $post_ids = $wpdb->get_results("SELECT object_id FROM $wpdb->term_relationships WHERE (term_taxonomy_id = 1777)");


    echo "<pre>";
    //print_r($post_ids); 
    //wp_die();

    foreach ($post_ids as $post_id) {
        $array = json_decode(json_encode($post_id), true);
        $term_obj_list = get_the_terms($array['object_id'], 'city');
        array_unique($term_obj_list);
        print_r($term_obj_list);
        wp_die();
        //$terms_string = join(', ', wp_list_pluck($term_obj_list, 'term_id'));
        echo '<option value="..">Select City</option>';


        //$term_taxonomy_id = $wpdb->get_results("SELECT DISTINCT term_taxonomy_id FROM $wpdb->term_relationships WHERE (object_id = ".$post_id->ID.")");

        $pages = get_posts(array(
            'post_type' => 'sales_network',
            'numberposts' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'city',
                    'field' => 'term_id',
                    'terms' => $term_obj_list[0]->term_id, /// Where term_id of Term 1 is "1".
                    //'include_children' => false
                )
            )
        ));
        echo "<pre>";
        print_r($pages);
    }
}



//echo "<pre>";

//print_r($post_id); 



while (have_posts()) : the_post();
?>

    <ul class="contactus-form-box">
        <li class="dropdown_has_child form-inline">
            <span>States:</span>


            <select name="" id="states" class="form-control" onchange="fetchcities(this.value)">
                <option value="All">All</option>
                <?php $tax_terms = get_terms('states', array('hide_empty' => false)); ?>
                <?php foreach ($tax_terms as $term_single) { ?>
                    <option value="<?php echo $term_single->term_id; ?>"><?php echo $term_single->name; ?></option>
                <?php } ?>
            </select>



        </li>
        <li class="dropdown_has_child form-inline">
            <span>City:</span>
            <select name="" id="cities" class="form-control" onchange="fetchposts(this.value)">
                <option value="All">Select</option>
               
            </select>
        </li>

    </ul>

    <div id="postsdata"></div>



    <!--./ Inner Page Container End ./-->
<?php
endwhile;
wp_reset_query(); ?>



<?php
get_footer();
?>
<script>
    function fetchcities(id) {
        jQuery('#cities').html('<option value="">Select</option>');
        jQuery.ajax({
            type: 'post',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                action: 'fetchcity',
                term_taxonomy_id: id
            },
            success: function(data) {
                console.log(data);
                let cities = data.data.cities;
                let unique = cities.filter((item, i, ar) => ar.indexOf(item) === i);
                console.log('cities',unique);
                let html = '<option value="">Select</option>';
                for(i=0;i<cities.length;i++){
                    term_ids = cities[i][0].term_id;
                    
                    console.log('term_ids',term_ids);
                    html += `<option value="${cities[i][0].term_id}">${cities[i][0].name}</option>`;
               
            }
                jQuery('#cities').html(html);
            }

        });
    }

    function fetchposts(id) {
        jQuery('#postsdata').html('<p>Please select state and city</p>');
        jQuery.ajax({
            type: 'post',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                action: 'fetchposts',
                city_id: id
            },
            success: function(data) {
                console.log('Posts:', data);
                let posts = data.data.posts;
                let html = '';
                for(post of posts){
                    html += `<h1>${post.post_name}</h1>`;
                }
                jQuery('#postsdata').html(html);
            }

        });
    }
</script>
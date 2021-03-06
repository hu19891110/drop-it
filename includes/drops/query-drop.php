<?php
/**
 * Custom Post Drop
 */
class Query_Drop_It_Drop extends Drop_It_Drop {
	static $_id = 'query';
	// Array 
	static $_allowed_query_args = array(
		// Author
		'author_name' => 'Author slug',
		// Category
		'cat' => 'Category ID',
		'category_name' => 'Category slug',
		'category__in' => 'Include categories (ids)',
		'category__not_in' => 'Exclude categories (ids)',
	);


	function __construct( $label = 'Custom Query', $template = 'query', $options = array() ) {
		parent::__construct( self::$_id, $label, $template, $options );
	}

	/**
	 * Add post itself for rendering (Front End)
	 *
	 * @param [type]  $drop [description]
	 * @return [type]       [description]
	 */
	function prepare_data( $drop = array() ) {
		return $drop;
	}

	function construct_query( $drop ) {

	}

	// Just for the sake of UI friendliness adding post_title and post_excerpt to returned data;
	function add_extra_info_for_ui( $meta ) {
		// Cast to array if it's an object
		$meta = (array) $meta;
		$post = (array) get_post( $meta['data'], 'ARRAY_A' );

		if ( !empty( $post ) )
			$meta = array_merge( $meta,
				array(
					'post_title' =>  $post['post_title'],
					'post_excerpt' => $post['post_excerpt'],
				) );

		return $meta;
	}

	/**
	 * Query create drop template is more complicated than the rest of bundled drops
	 * @return string HTML
	 */
	function action_di_create_drop_templates() {
?>
<script type="text/template" id="query_create_drop_template">
	<p>Most of the parameters accept comma separated values. Check out <a target="_blank" href="http://codex.wordpress.org/Class_Reference/WP_Query#Parameters">WP_Query reference</a></p>
		<div class="drop-input-wrapper">
			<label>Title</label>
			<input type="text" name="title" id="title" placeholder="Title" />
		</div>
		<input type="hidden" name="data" />
		<label>Parameters</label>

		<div class="drop-input-wrapper drop-query-param-wrapper">			
			<select name="data[key][]" class="drop-query-parameter create-drop-parameter">
				<?php foreach ( self::$_allowed_query_args as $key => $label ): ?>
					<option value="<?php echo $key ?>"><?php echo $label ?></option>
				<?php endforeach ?>
			</select>
			<input type="text" name="data[value][]" placeholder="Value" />
		</div>

		<div class="drop-input-wrapper">
			<button class="button button-add-query-arg">Add another argument</button>
		</div>
		<input type="hidden" name='type' value="<%- type %>" />

</script>
<?php
	}

	function action_di_edit_drop_templates() {
?>
<script type="text/template" id="query_drop_template">
	<div class="widget-inside">
		Query
	</div>
	<div class="widget-inside-edit">
	
	</div>	
</script>
<?php
	}
}

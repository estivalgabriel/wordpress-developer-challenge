<?php
// Taxonomia para Categorias
function custom_taxonomy_categoria_videos() {

	$labels = array(
		'name'                       => _x( 'Categorias de Vídeos', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Categoria de Vídeo', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Categorias de Vídeos', 'text_domain' ),
		'all_items'                  => __( 'Todos as Categorias', 'text_domain' ),
		'parent_item'                => __( 'Categoria Mãe', 'text_domain' ),
		'parent_item_colon'          => __( 'Categoria Mãe:', 'text_domain' ),
		'new_item_name'              => __( 'Nova Categoria', 'text_domain' ),
		'add_new_item'               => __( 'Adicionar Nova Categoria', 'text_domain' ),
		'edit_item'                  => __( 'Editar Categoria', 'text_domain' ),
		'update_item'                => __( 'Atualizar Categoria', 'text_domain' ),
		'view_item'                  => __( 'Visualizar Categoria', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separe os itens com vírgula', 'text_domain' ),
		'add_or_remove_items'        => __( 'Adicione ou Remova', 'text_domain' ),
		'choose_from_most_used'      => __( 'Escolha o mais usado', 'text_domain' ),
		'popular_items'              => __( 'Categorias Populares', 'text_domain' ),
		'search_items'               => __( 'Procure Categorias', 'text_domain' ),
		'not_found'                  => __( 'Não Encontrado', 'text_domain' ),
		'no_terms'                   => __( 'Sem Categorias', 'text_domain' ),
		'items_list'                 => __( 'Lista de itens', 'text_domain' ),
		'items_list_navigation'      => __( 'Lista de itens de navegação', 'text_domain' ),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'    							 => true,
	);

	register_taxonomy( 'categoria_videos', 'videos', $args );

}
add_action( 'init', 'custom_taxonomy_categoria_videos', 2 );

/* cria o link no menu */
function add_custom_post_videos(){
  $args_videos_post_type = array(
    'labels' => array('name' => 'Vídeos'),
    'public' => false,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'menu_icon' => 'dashicons-video-alt3',
    'supports' => array('title', 'thumbnail') );
  register_post_type( 'videos' , $args_videos_post_type );
}
add_action( 'init' , 'add_custom_post_videos');


// metabox informações gerais
function videos_meta_box(){
  add_meta_box( 'info_videos', __('Vídeos'), 'info_videos', 'videos', 'normal', 'high' );
}
add_action('add_meta_boxes', 'videos_meta_box');


/* html campos */
function info_videos(){
	global $post;

	$input_videos_titulo = get_post_meta( $post->ID, 'input_videos_titulo', true );
	$input_videos_descricao = get_post_meta( $post->ID, 'input_videos_descricao', true );
	$input_videos_duracao = get_post_meta( $post->ID, 'input_videos_duracao', true );
	$input_videos_sinopse = get_post_meta( $post->ID, 'input_videos_sinopse', true );
	$input_videos_embed = get_post_meta( $post->ID, 'input_videos_embed', true );

	?>

	<label for="titulo">Título: </label>
	<input type="text" name="input_videos_titulo" id="input_videos_titulo" placeholder="Informe o título" value="<?php echo $input_videos_titulo; ?>">

	<label for="descricao">Descrição: </label>
	<textarea name="input_videos_descricao" id="input_videos_descricao" placeholder="Informe uma descrição" rows="8" cols="80"><?php echo $input_videos_descricao; ?></textarea>

	<label for="duracao">Duração: </label>
	<input type="text" name="input_videos_duracao" id="input_videos_duracao" placeholder="Informe a duração" value="<?php echo $input_videos_duracao; ?>">

	<label for="sinopse">Sinopse: </label>
	<textarea name="input_videos_sinopse" id="input_videos_sinopse" placeholder="Informe a sinopse" rows="8" cols="80"><?php echo $input_videos_sinopse; ?></textarea>

	<label for="embed">Link: </label>
	<textarea name="input_videos_embed" id="input_videos_embed" placeholder="Informe o link" rows="4" cols="10"><?php echo $input_videos_embed; ?></textarea>

	<?php
}

/* salva os campos */
function salvar_campos_videos(){
	global $post;
	update_post_meta( $post->ID, 'input_videos_titulo', $_POST['input_videos_titulo'] );
	update_post_meta( $post->ID, 'input_videos_descricao', $_POST['input_videos_descricao'] );
	update_post_meta( $post->ID, 'input_videos_duracao', $_POST['input_videos_duracao'] );
	update_post_meta( $post->ID, 'input_videos_sinopse', $_POST['input_videos_sinopse'] );
	update_post_meta( $post->ID, 'input_videos_embed', $_POST['input_videos_embed'] );
}
add_action( 'save_post' , 'salvar_campos_videos' );

?>

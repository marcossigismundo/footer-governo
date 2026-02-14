<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ---------- Menu ---------- */
function footer_governo_admin_menu() {
    add_options_page(
        'Footer Governo Federal',
        'Footer Governo',
        'manage_options',
        'footer-governo',
        'footer_governo_settings_page'
    );
}
add_action( 'admin_menu', 'footer_governo_admin_menu' );

/* ---------- Save ---------- */
function footer_governo_save_settings() {
    if (
        ! isset( $_POST['footer_governo_nonce'] ) ||
        ! wp_verify_nonce( $_POST['footer_governo_nonce'], 'footer_governo_save' ) ||
        ! current_user_can( 'manage_options' )
    ) {
        return;
    }

    $columns = array();

    if ( ! empty( $_POST['fg_col_title'] ) && is_array( $_POST['fg_col_title'] ) ) {
        $titles = array_map( 'sanitize_text_field', $_POST['fg_col_title'] );
        $labels = isset( $_POST['fg_link_label'] ) ? $_POST['fg_link_label'] : array();
        $urls   = isset( $_POST['fg_link_url'] ) ? $_POST['fg_link_url'] : array();

        foreach ( $titles as $i => $title ) {
            $col = array(
                'title' => $title,
                'links' => array(),
            );

            if ( isset( $labels[ $i ] ) && is_array( $labels[ $i ] ) ) {
                foreach ( $labels[ $i ] as $j => $label ) {
                    $label = sanitize_text_field( $label );
                    $url   = isset( $urls[ $i ][ $j ] ) ? esc_url_raw( $urls[ $i ][ $j ] ) : '';
                    if ( $label && $url ) {
                        $col['links'][] = array(
                            'label' => $label,
                            'url'   => $url,
                        );
                    }
                }
            }

            if ( $title ) {
                $columns[] = $col;
            }
        }
    }

    update_option( 'footer_governo_columns', $columns );

    add_settings_error( 'footer_governo', 'saved', 'Configurações salvas.', 'updated' );
}
add_action( 'admin_init', 'footer_governo_save_settings' );

/* ---------- Reset to defaults ---------- */
function footer_governo_handle_reset() {
    if (
        ! isset( $_POST['footer_governo_reset_nonce'] ) ||
        ! wp_verify_nonce( $_POST['footer_governo_reset_nonce'], 'footer_governo_reset' ) ||
        ! current_user_can( 'manage_options' )
    ) {
        return;
    }

    update_option( 'footer_governo_columns', footer_governo_default_columns() );
    add_settings_error( 'footer_governo', 'reset', 'Dados restaurados para o padrão (MMA).', 'updated' );
}
add_action( 'admin_init', 'footer_governo_handle_reset' );

/* ---------- Admin page ---------- */
function footer_governo_settings_page() {
    $columns = get_option( 'footer_governo_columns', footer_governo_default_columns() );
    ?>
    <div class="wrap">
        <h1>Footer do Governo Federal</h1>
        <?php settings_errors( 'footer_governo' ); ?>

        <p>Edite as colunas e links do rodapé. Para trocar de ministério, altere os títulos e links abaixo ou restaure os dados padrão (MMA).</p>

        <form method="post" id="fg-settings-form">
            <?php wp_nonce_field( 'footer_governo_save', 'footer_governo_nonce' ); ?>

            <div id="fg-columns-wrap">
                <?php foreach ( $columns as $i => $col ) : ?>
                    <div class="fg-admin-column" data-index="<?php echo $i; ?>">
                        <div class="fg-admin-column-header">
                            <h3>Coluna <?php echo $i + 1; ?></h3>
                            <button type="button" class="button fg-remove-column">Remover coluna</button>
                        </div>
                        <table class="form-table">
                            <tr>
                                <th><label>Título da coluna</label></th>
                                <td><input type="text" name="fg_col_title[<?php echo $i; ?>]" value="<?php echo esc_attr( $col['title'] ); ?>" class="regular-text"></td>
                            </tr>
                        </table>
                        <h4>Links</h4>
                        <div class="fg-links-wrap">
                            <?php foreach ( $col['links'] as $j => $link ) : ?>
                                <div class="fg-link-row">
                                    <input type="text" name="fg_link_label[<?php echo $i; ?>][<?php echo $j; ?>]" value="<?php echo esc_attr( $link['label'] ); ?>" placeholder="Texto do link" class="regular-text">
                                    <input type="url" name="fg_link_url[<?php echo $i; ?>][<?php echo $j; ?>]" value="<?php echo esc_url( $link['url'] ); ?>" placeholder="https://..." class="regular-text">
                                    <button type="button" class="button fg-remove-link">✕</button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" class="button fg-add-link">+ Adicionar link</button>
                        <hr>
                    </div>
                <?php endforeach; ?>
            </div>

            <p>
                <button type="button" class="button button-secondary" id="fg-add-column">+ Adicionar coluna</button>
            </p>

            <?php submit_button( 'Salvar alterações' ); ?>
        </form>

        <hr>
        <h3>Restaurar padrão</h3>
        <p>Restaura todos os dados do footer para os valores padrão do Ministério do Meio Ambiente.</p>
        <form method="post">
            <?php wp_nonce_field( 'footer_governo_reset', 'footer_governo_reset_nonce' ); ?>
            <?php submit_button( 'Restaurar padrão (MMA)', 'secondary', 'submit', false ); ?>
        </form>
    </div>

    <style>
        .fg-admin-column { background: #fff; border: 1px solid #ccd0d4; padding: 16px 20px; margin-bottom: 16px; }
        .fg-admin-column-header { display: flex; align-items: center; justify-content: space-between; }
        .fg-admin-column-header h3 { margin: 0; }
        .fg-link-row { display: flex; gap: 8px; align-items: center; margin-bottom: 6px; }
        .fg-link-row input { flex: 1; }
        .fg-link-row .fg-remove-link { flex-shrink: 0; color: #a00; }
        .fg-links-wrap { margin-bottom: 10px; }
        .fg-add-link { margin-bottom: 8px; }
    </style>

    <script>
    (function(){
        var wrap = document.getElementById('fg-columns-wrap');

        function reindex() {
            var cols = wrap.querySelectorAll('.fg-admin-column');
            cols.forEach(function(col, ci) {
                col.setAttribute('data-index', ci);
                col.querySelector('h3').textContent = 'Coluna ' + (ci + 1);
                col.querySelector('input[name^="fg_col_title"]').name = 'fg_col_title[' + ci + ']';
                var rows = col.querySelectorAll('.fg-link-row');
                rows.forEach(function(row, ri) {
                    var inputs = row.querySelectorAll('input');
                    inputs[0].name = 'fg_link_label[' + ci + '][' + ri + ']';
                    inputs[1].name = 'fg_link_url[' + ci + '][' + ri + ']';
                });
            });
        }

        document.getElementById('fg-add-column').addEventListener('click', function() {
            var ci = wrap.querySelectorAll('.fg-admin-column').length;
            var html = '<div class="fg-admin-column" data-index="'+ci+'">'
                + '<div class="fg-admin-column-header"><h3>Coluna '+(ci+1)+'</h3>'
                + '<button type="button" class="button fg-remove-column">Remover coluna</button></div>'
                + '<table class="form-table"><tr><th><label>Título da coluna</label></th>'
                + '<td><input type="text" name="fg_col_title['+ci+']" value="" class="regular-text"></td></tr></table>'
                + '<h4>Links</h4><div class="fg-links-wrap"></div>'
                + '<button type="button" class="button fg-add-link">+ Adicionar link</button><hr></div>';
            wrap.insertAdjacentHTML('beforeend', html);
        });

        wrap.addEventListener('click', function(e) {
            if (e.target.classList.contains('fg-add-link')) {
                var col = e.target.closest('.fg-admin-column');
                var ci = col.getAttribute('data-index');
                var linksWrap = col.querySelector('.fg-links-wrap');
                var ri = linksWrap.querySelectorAll('.fg-link-row').length;
                var html = '<div class="fg-link-row">'
                    + '<input type="text" name="fg_link_label['+ci+']['+ri+']" placeholder="Texto do link" class="regular-text">'
                    + '<input type="url" name="fg_link_url['+ci+']['+ri+']" placeholder="https://..." class="regular-text">'
                    + '<button type="button" class="button fg-remove-link">✕</button></div>';
                linksWrap.insertAdjacentHTML('beforeend', html);
            }
            if (e.target.classList.contains('fg-remove-link')) {
                e.target.closest('.fg-link-row').remove();
                reindex();
            }
            if (e.target.classList.contains('fg-remove-column')) {
                e.target.closest('.fg-admin-column').remove();
                reindex();
            }
        });
    })();
    </script>
    <?php
}

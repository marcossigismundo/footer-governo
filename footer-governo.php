<?php
/**
 * Plugin Name: Footer do Governo Federal
 * Plugin URI:  https://www.gov.br
 * Description: Insere o rodapé padrão do Governo Federal com colunas editáveis no painel administrativo.
 * Version:     1.0.0
 * Author:      Governo Federal
 * License:     GPL-2.0-or-later
 * Text Domain: footer-governo
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'FOOTER_GOVERNO_VERSION', '1.0.0' );
define( 'FOOTER_GOVERNO_URL', plugin_dir_url( __FILE__ ) );
define( 'FOOTER_GOVERNO_PATH', plugin_dir_path( __FILE__ ) );

/* ---------- Admin ---------- */
require_once FOOTER_GOVERNO_PATH . 'admin/admin-settings.php';

/* ---------- Frontend assets ---------- */
function footer_governo_enqueue_assets() {
    wp_enqueue_style(
        'footer-governo',
        FOOTER_GOVERNO_URL . 'assets/css/footer-governo.css',
        array(),
        FOOTER_GOVERNO_VERSION
    );
}
add_action( 'wp_enqueue_scripts', 'footer_governo_enqueue_assets' );

/* ---------- Default data (MMA) ---------- */
function footer_governo_default_columns() {
    return array(
        array(
            'title' => 'ASSUNTOS',
            'links' => array(
                array( 'label' => 'Notícias', 'url' => 'https://www.gov.br/mma/pt-br/assuntos/noticias' ),
                array( 'label' => 'Consultas Públicas', 'url' => 'https://www.gov.br/mma/pt-br/assuntos/consultas-publicas' ),
                array( 'label' => 'Biodiversidade e Biomas', 'url' => 'https://www.gov.br/mma/pt-br/assuntos/biodiversidade-e-biomas' ),
                array( 'label' => 'Mudança do Clima', 'url' => 'https://www.gov.br/mma/pt-br/assuntos/mudanca-do-clima' ),
                array( 'label' => 'Controle do Desmatamento, Queimadas e Ordenamento Ambiental Territorial', 'url' => 'https://www.gov.br/mma/pt-br/assuntos/controle-ao-desmatamento-queimadas-e-ordenamento-ambiental-territorial' ),
                array( 'label' => 'Bioeconomia', 'url' => 'https://www.gov.br/mma/pt-br/assuntos/bioeconomia' ),
                array( 'label' => 'Meio Ambiente Urbano, Recursos Hídricos e Qualidade Ambiental', 'url' => 'https://www.gov.br/mma/pt-br/assuntos/meio-ambiente-urbano-recursos-hidricos-qualidade-ambiental' ),
                array( 'label' => 'Povos e Comunidades Tradicionais', 'url' => 'https://www.gov.br/mma/pt-br/assuntos/povos-e-comunidades-tradicionais' ),
                array( 'label' => 'Assuntos transversais', 'url' => 'https://www.gov.br/mma/pt-br/assuntos/assuntos-transversais' ),
                array( 'label' => '5ª Conferência Nacional do Meio Ambiente', 'url' => 'https://www.gov.br/mma/pt-br/assuntos/5a-conferencia-nacional-do-meio-ambiente' ),
                array( 'label' => 'Educação Ambiental', 'url' => 'https://www.gov.br/mma/pt-br/assuntos/educacao-ambiental' ),
                array( 'label' => 'COP30', 'url' => 'https://www.gov.br/mma/pt-br/assuntos/cop30' ),
            ),
        ),
        array(
            'title' => 'ACESSO À INFORMAÇÃO',
            'links' => array(
                array( 'label' => '1. Institucional', 'url' => 'https://www.gov.br/mma/pt-br/acesso-a-informacao/institucional-quem-e-quem' ),
                array( 'label' => '2. Ações e Programas', 'url' => 'https://www.gov.br/mma/pt-br/acesso-a-informacao/acoes-e-programas' ),
                array( 'label' => '3. Participação Social', 'url' => 'https://www.gov.br/mma/pt-br/acesso-a-informacao/participacao-social' ),
                array( 'label' => '4. Auditorias', 'url' => 'https://www.gov.br/mma/pt-br/acesso-a-informacao/4-auditorias' ),
                array( 'label' => '5. Convênio e Transferências', 'url' => 'https://www.gov.br/mma/pt-br/acesso-a-informacao/5-convenio-e-transferencias' ),
                array( 'label' => '6. Receitas e Despesas', 'url' => 'https://www.gov.br/mma/pt-br/acesso-a-informacao/6-receitas-e-despesas' ),
                array( 'label' => '7. Licitações e Contratos', 'url' => 'https://www.gov.br/mma/pt-br/acesso-a-informacao/licitacoes-e-contratos' ),
                array( 'label' => '8. Servidores (ou Empregados Públicos)', 'url' => 'https://www.gov.br/mma/pt-br/acesso-a-informacao/8-servidores-ou-empregados-publicos' ),
                array( 'label' => '9. Informações Classificadas', 'url' => 'https://www.gov.br/mma/pt-br/acesso-a-informacao/informacoes-classificadas' ),
                array( 'label' => '10. Serviço de Informação ao Cidadão - SIC', 'url' => 'https://www.gov.br/mma/pt-br/acesso-a-informacao/10-servico-de-informacao-ao-cidadao-sic' ),
                array( 'label' => '11. Perguntas Frequentes', 'url' => 'https://www.gov.br/mma/pt-br/acesso-a-informacao/perguntas-frequentes' ),
                array( 'label' => '12. Dados Abertos', 'url' => 'https://www.gov.br/mma/pt-br/acesso-a-informacao/dados-abertos' ),
                array( 'label' => '13. Sanções Administrativas', 'url' => 'https://www.gov.br/mma/pt-br/acesso-a-informacao/sancoes-administrativas' ),
                array( 'label' => '14. Ferramentas e Aspectos Tecnológicos dos Sites Institucionais', 'url' => 'https://www.gov.br/mma/pt-br/acesso-a-informacao/ferramentas-e-aspectos-tecnologicos' ),
            ),
        ),
        array(
            'title' => 'COMPOSIÇÃO',
            'links' => array(
                array( 'label' => 'Gabinete da Ministra', 'url' => 'https://www.gov.br/mma/pt-br/composicao/gabinete-da-ministra' ),
                array( 'label' => 'Secretaria Executiva', 'url' => 'https://www.gov.br/mma/pt-br/composicao/secretaria-executiva' ),
                array( 'label' => 'Secretaria Nacional de Biodiversidade, Florestas e Direitos Animais', 'url' => 'https://www.gov.br/mma/pt-br/composicao/sbc' ),
                array( 'label' => 'Secretaria Nacional de Bioeconomia', 'url' => 'https://www.gov.br/mma/pt-br/composicao/sbc' ),
                array( 'label' => 'Secretaria Extraordinária de Controle do Desmatamento e Ordenamento Ambiental Territorial', 'url' => 'https://www.gov.br/mma/pt-br/composicao/secd' ),
                array( 'label' => 'Secretaria Nacional de Meio Ambiente Urbano, Recursos Hídricos e Qualidade Ambiental', 'url' => 'https://www.gov.br/mma/pt-br/composicao/smaurh' ),
                array( 'label' => 'Secretaria Nacional de Mudança do Clima', 'url' => 'https://www.gov.br/mma/pt-br/composicao/smc' ),
                array( 'label' => 'Secretaria Nacional de Povos e Comunidades Tradicionais e Desenvolvimento Rural Sustentável', 'url' => 'https://www.gov.br/mma/pt-br/composicao/spct' ),
            ),
        ),
        array(
            'title' => 'CENTRAIS DE CONTEÚDO',
            'links' => array(
                array( 'label' => 'Publicações', 'url' => 'https://www.gov.br/mma/pt-br/centrais-de-conteudo/publicacoes' ),
                array( 'label' => 'Legislação', 'url' => 'https://www.gov.br/mma/pt-br/centrais-de-conteudo/legislacao' ),
                array( 'label' => 'Vídeos', 'url' => 'https://www.gov.br/mma/pt-br/centrais-de-conteudo/videos' ),
                array( 'label' => 'Imagens', 'url' => 'https://www.gov.br/mma/pt-br/centrais-de-conteudo/imagens' ),
                array( 'label' => 'Áudios', 'url' => 'https://www.gov.br/mma/pt-br/centrais-de-conteudo/audios' ),
                array( 'label' => 'Marca Ministério do Meio Ambiente e Mudança do Clima', 'url' => 'https://www.gov.br/mma/pt-br/centrais-de-conteudo/marca' ),
            ),
        ),
        array(
            'title' => 'CANAIS DE ATENDIMENTO',
            'links' => array(
                array( 'label' => 'Endereços Importantes', 'url' => 'https://www.gov.br/mma/pt-br/canais-de-atendimento/enderecos' ),
                array( 'label' => 'Ouvidoria', 'url' => 'https://www.gov.br/mma/pt-br/canais-de-atendimento/ouvidoria' ),
                array( 'label' => 'Atendimento à imprensa', 'url' => 'https://www.gov.br/mma/pt-br/canais-de-atendimento/imprensa' ),
                array( 'label' => 'Processo Eletrônico', 'url' => 'https://www.gov.br/mma/pt-br/canais-de-atendimento/processo-eletronico' ),
            ),
        ),
        array(
            'title' => 'REDES SOCIAIS/CANAIS',
            'links' => array(
                array( 'label' => 'Flickr', 'url' => 'https://www.flickr.com/photos/maborhes/' ),
                array( 'label' => 'Instagram', 'url' => 'https://www.instagram.com/maborhes/' ),
                array( 'label' => 'Facebook', 'url' => 'https://www.facebook.com/MinisteriodoMeioAmbiente' ),
                array( 'label' => 'Youtube', 'url' => 'https://www.youtube.com/user/MMAgovbr' ),
                array( 'label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/company/ministerio-do-meio-ambiente/' ),
                array( 'label' => 'Bluesky', 'url' => 'https://bsky.app/profile/meioambiente.gov.br' ),
                array( 'label' => 'Threads', 'url' => 'https://www.threads.net/@meioambientegovbr' ),
                array( 'label' => 'TikTok', 'url' => 'https://www.tiktok.com/@meioambientegovbr' ),
            ),
        ),
    );
}

/* ---------- Activation: set default data ---------- */
function footer_governo_activate() {
    if ( false === get_option( 'footer_governo_columns' ) ) {
        update_option( 'footer_governo_columns', footer_governo_default_columns() );
    }
}
register_activation_hook( __FILE__, 'footer_governo_activate' );

/* ---------- Render footer ---------- */
function footer_governo_render() {
    $columns = get_option( 'footer_governo_columns', footer_governo_default_columns() );
    if ( empty( $columns ) ) {
        return;
    }
    ?>
    <footer id="footer-governo" role="contentinfo" aria-label="Rodapé do Governo Federal">
        <div class="fg-top">
            <div class="fg-container">
                <div class="fg-logo">
                    <a href="https://www.gov.br/pt-br" target="_blank" rel="noopener noreferrer">
                        <img src="https://barra.sistema.gov.br/v1/assets/govbr.webp"
                             alt="Logo GovBR"
                             height="32"
                             loading="lazy">
                    </a>
                </div>
            </div>
        </div>
        <div class="fg-columns-wrapper">
            <div class="fg-container">
                <div class="fg-columns">
                    <?php foreach ( $columns as $col ) : ?>
                        <div class="fg-column">
                            <h4 class="fg-column-title"><?php echo esc_html( $col['title'] ); ?></h4>
                            <ul>
                                <?php foreach ( $col['links'] as $link ) : ?>
                                    <li>
                                        <a href="<?php echo esc_url( $link['url'] ); ?>"
                                           target="_blank"
                                           rel="noopener noreferrer">
                                            <?php echo esc_html( $link['label'] ); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </footer>
    <?php
}
add_action( 'wp_footer', 'footer_governo_render', 99 );

const ven_card_settings = window.wc.wcSettings.getSetting( 'woocommerce_vendreo_card_gateway_data', {} );
const ven_card_label = window.wp.htmlEntities.decodeEntities( ven_card_settings.title ) || window.wp.i18n.__( 'Pay by Vendreo (Card)', 'woocommerce_vendreo_card_gateway' );
const Content = () => {
    return window.wp.htmlEntities.decodeEntities( ven_card_settings.description || '' );
};

const ven_card_block_gateway = {
    name: 'woocommerce_vendreo_card_gateway',
    label: ven_card_label,
    content: Object( window.wp.element.createElement )( Content, null ),
    edit: Object( window.wp.element.createElement )( Content, null ),
    canMakePayment: () => true,
    ariaLabel: ven_card_label,
    supports: {
        features: ven_card_settings.supports,
    },
};

window.wc.wcBlocksRegistry.registerPaymentMethod( ven_card_block_gateway );

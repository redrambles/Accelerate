/**
 * Dashboard Layout View
 *
 * @package Ninja Forms
 * @subpackage Dashboard
 * @copyright (c) 2017 WP Ninjas
 * @since 3.2
 */
define( [ 'views/sections/widgets.js', 'views/sections/apps.js', 'views/sections/memberships.js' ], function( WidgetView, AppsView, MembershipsView ) {
    var view = Marionette.View.extend( {
        template: "#tmpl-nf-dashboard",
        
        currentView: 'widgets',

        regions: {
            content: '.content'
        },

        events: {
            'click .widgets a': function(e){
                this.showChildView( 'content', new WidgetView() );
                jQuery( '.' + this.currentView).find( 'a' ).removeClass( 'active' );
                e.target.classList.add( 'active' );
                this.currentView = 'widgets';
            },
            'click .apps a': function(e){
                this.showChildView( 'content', new AppsView() );
                jQuery( '.' + this.currentView).find( 'a' ).removeClass( 'active' );
                e.target.classList.add( 'active' );
                this.currentView = 'apps';
            },
            'click .memberships a': function(e){
                this.showChildView( 'content', new MembershipsView() );
                jQuery( '.' + this.currentView).find( 'a' ).removeClass( 'active' );
                e.target.classList.add( 'active' );
                this.currentView = 'memberships';
            },
        },

        initialize: function() {
            switch( window.location.hash ) {
                case '#apps':
                    this.currentView = 'apps';
                    break;
                case '#memberships':
                    this.currentView = 'memberships';
                    break;
                case '#widgets':
                default:
                    this.currentView = 'widgets';
            }

            /**
             * Radio Routers
             * TODO: Clean this up.
             */
            nfRadio.channel( 'dashboard' ).reply( 'show:widgets', function(){
                this.showChildView('content', new WidgetView() );
                jQuery( 'nav.sections a.active' ).removeClass( 'active' );
                jQuery( 'nav.sections .widgets a' ).addClass( 'active' );
                this.currentView = 'widgets';
            }, this );
            nfRadio.channel( 'dashboard' ).reply( 'show:apps', function(){
                this.showChildView('content', new AppsView() );
                jQuery( 'nav.sections a.active' ).removeClass( 'active' );
                jQuery( 'nav.sections .apps a' ).addClass( 'active' );
                this.currentView = 'apps';
            }, this );
        },

        onRender: function() {
            switch( window.location.hash ) {
                case '#apps':
                    var childView = new AppsView();
                    break;
                case '#memberships':
                    var childView = new MembershipsView();
                    break;
                case '#widgets':
                default:
                    var childView = new WidgetView();
            }
            this.showChildView('content', childView );
            // If form telemetry is defined...
            // AND if we should run it...
            if ( 'undefined' !== typeof nfAdmin.formTelemetry && 1 == nfAdmin.formTelemetry ) {
                // Make our AJAX call.
                var data = {
                    action: 'nf_form_telemetry',
                    security: nfAdmin.ajaxNonce
                }
                // Make our AJAX call.
                jQuery.post( ajaxurl, data );
            }
            // If the user has not seen the opt-in modal yet...
            if ( '1' == nfAdmin.showOptin ) {
                // Declare all of our opt-in code here.
                var optinModal = new jBox( 'Modal', {
                    closeOnEsc:     false,
                    closeOnClick:   false,
                    width:          400
                } );
                // Define the modal title.
                var title = document.createElement( 'div' );
                title.id = 'optin-modal-title';
                var titleStyling = document.createElement( 'h2' );
                titleStyling.innerHTML = 'Help make Ninja Forms better!';
                title.appendChild( titleStyling );
                // Define the modal content.
                var content = document.createElement( 'div' );
                content.classList.add( 'message' );
                content.style.padding = '0px 20px 20px 20px';
                content.innerHTML = nfi18n.optinContent;
                var p = document.createElement( 'p' );
                p.style.paddingBottom = '10px';
                var checkBox = document.createElement( 'input' );
                checkBox.id = 'optin-send-email';
                checkBox.setAttribute( 'type', 'checkbox' );
                checkBox.style.margin = '7px';
                var label = document.createElement( 'label' );
                label.setAttribute( 'for', 'optin-send-email' );
                label.innerHTML = nfi18n.optinYesplease;
                p.appendChild( checkBox );
                p.appendChild( label );
                content.appendChild( p );
                p = document.createElement( 'p' );
                p.id = 'optin-block';
                p.style.padding = '0px 5px 20px 5px';
                p.style.display = 'none';
                var email = document.createElement( 'input' );
                email.id = 'optin-email-address';
                email.setAttribute( 'type', 'text' );
                email.setAttribute( 'value', nfAdmin.currentUserEmail );
                email.style.width = '100%';
                email.style.fontSize = '16px';
                p.appendChild( email );
                content.appendChild( p );
                var spinner = document.createElement( 'span' );
                spinner.id = 'optin-spinner';
                spinner.classList.add( 'spinner' );
                spinner.style.display = 'none';
                content.appendChild( spinner );
                var actions = document.createElement( 'div' );
                actions.id = 'optin-buttons';
                actions.classList.add( 'buttons' );
                var cancel = document.createElement( 'div' );
                cancel.id = 'optout';
                cancel.classList.add( 'nf-button', 'secondary' );
                cancel.innerHTML = nfi18n.optinSecondary;
                actions.appendChild( cancel );
                var confirm = document.createElement( 'button' );
                confirm.id = 'optin';
                confirm.classList.add( 'nf-button', 'primary', 'pull-right' );
                confirm.innerHTML = nfi18n.optinPrimary;
                actions.appendChild( confirm );
                content.appendChild( actions );
                // Define the success title.
                var successTitle = document.createElement( 'h2' );
                successTitle.innerHTML = nfi18n.optinAwesome;
                // Define the success content.
                var successContent = document.createElement( 'div' );
                successContent.id = 'optin-thankyou';
                successContent.classList.add( 'message' );
                successContent.style.padding = '20px';
                successContent.innerHTML = nfi18n.optinThanks;
                // Set the options for the modal and open it.
                optinModal.setContent( document.createElement( 'div' ).appendChild( content ).innerHTML );
                optinModal.setTitle( document.createElement( 'div' ).appendChild( title ).innerHTML );
                optinModal.open();
                // Show/Hide email field, based on the opt-in checkbox.
                jQuery( '#optin-send-email' ).click( function( e ) {
                    if( jQuery( this ).is( ':checked' ) ) {
                        jQuery( '#optin-block' ).show();
                    } else {
                        jQuery( '#optin-block' ).hide();
                    }
                } );
                // Setup the optin click event.
                jQuery( '#optin' ).click( function( e ) {
                    var sendEmail;

                    if ( jQuery( '#optin-send-email' ).attr( 'checked' ) ) {
                        sendEmail = 1;
                        userEmail = jQuery( '#optin-email-address' ).val();
                    } else {
                        sendEmail = 0;
                        userEmail = '';
                    }

                    // Show spinner
                    jQuery( '#optin-spinner' ).css( 'visibility', 'visible' );
                    jQuery( '#optin-spinner' ).css( 'display', 'inline-block' );
                    jQuery( '#optin-buttons' ).css( 'visibility', 'hidden' );
                    // Hit AJAX endpoint and opt-in.
                    jQuery.post( ajaxurl, { action: 'nf_optin', ninja_forms_opt_in: 1, send_email: sendEmail, user_email: userEmail },
                                function( response ) {
                        jQuery( '#optin-spinner' ).css( 'visibility', 'hidden' );
                        jQuery( '#optin-spinner' ).css( 'display', 'none' );
                        optinModal.setTitle( document.createElement( 'div' ).appendChild( successTitle ).innerHTML );
                        optinModal.setContent( document.createElement( 'div' ).appendChild( successContent ).innerHTML );
                        /**
                         * When we get a response from our endpoint, show a thank you and set a timeout
                         * to close the modal.
                         */
                        setTimeout (
                            function(){
                                optinModal.close();
                            },
                            2000
                        );
                    } );            
                } );
                // Setup the optout click event.
                jQuery( '#optout' ).click( function( e ) {
                    // Show spinner
                    jQuery( '#optin-spinner' ).css( 'visibility', 'visible' );
                    jQuery( '#optin-buttons' ).css( 'visibility', 'hidden' );
                    // Hit AJAX endpoint and opt-in.
                     jQuery.post( ajaxurl, { action: 'nf_optin', ninja_forms_opt_in: 0 }, function( response ) {
                        jQuery( '#optin-spinner' ).css( 'visibility', 'hidden' );
                        // When we get a response from our endpoint, close the modal. 
                        optinModal.close();
                    } );            
                } );
            }
        },
        
        templateContext: function() {
            var that = this;
            return {
                renderNav: function() {
                    var content = document.createElement( 'div' );
                    _.each( nfDashItems, function(section) {
                        var item = document.createElement( 'li' );
                        var link = document.createElement( 'a' );
                        link.href = '#' + section.slug;
                        if ( that.currentView == section.slug ) link.classList.add( 'active' );
                        link.innerHTML = section.niceName;
                        item.classList.add( section.slug );
                        item.appendChild( link );
                        content.appendChild( item );
                    } );
                    return content.innerHTML;
                },
            }
        }
    } );
    return view;
} );

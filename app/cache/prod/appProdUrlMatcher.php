<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // sonata_demo_media
        if ($pathinfo === '/media') {
            return array (  '_controller' => 'Sonata\\Bundle\\DemoBundle\\Controller\\DemoController::mediaAction',  '_route' => 'sonata_demo_media',);
        }

        if (0 === strpos($pathinfo, '/car')) {
            // sonata_demo_car
            if ($pathinfo === '/car') {
                return array (  '_controller' => 'Sonata\\Bundle\\DemoBundle\\Controller\\DemoController::carAction',  '_route' => 'sonata_demo_car',);
            }

            // sonata_demo_car_rescue
            if ($pathinfo === '/car-rescue-engine') {
                return array (  '_controller' => 'Sonata\\Bundle\\DemoBundle\\Controller\\DemoController::carRescueEngineAction',  '_route' => 'sonata_demo_car_rescue',);
            }

        }

        // sonata_demo_newsletter
        if ($pathinfo === '/newsletter') {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_sonata_demo_newsletter;
            }

            return array (  '_controller' => 'Sonata\\Bundle\\DemoBundle\\Controller\\DemoController::newsletterAction',  '_route' => 'sonata_demo_newsletter',);
        }
        not_sonata_demo_newsletter:

        if (0 === strpos($pathinfo, '/qa')) {
            // sonata_page_bundle_inner_controller
            if ($pathinfo === '/qa/page/controller-helper') {
                return array (  '_controller' => 'Sonata\\Bundle\\QABundle\\Controller\\PageController::controllerHelperAction',  '_route' => 'sonata_page_bundle_inner_controller',);
            }

            // sonata_qa_serialize
            if ($pathinfo === '/qa/serialize') {
                return array (  '_controller' => 'Sonata\\Bundle\\QABundle\\Controller\\SerializerController::serializeAction',  '_route' => 'sonata_qa_serialize',);
            }

        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // fos_user_security_login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::loginAction',  '_route' => 'fos_user_security_login',);
                }

                // fos_user_security_check
                if ($pathinfo === '/login_check') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::checkAction',  '_route' => 'fos_user_security_check',);
                }

            }

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::logoutAction',  '_route' => 'fos_user_security_logout',);
            }

            if (0 === strpos($pathinfo, '/login')) {
                // sonata_user_security_login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::loginAction',  '_route' => 'sonata_user_security_login',);
                }

                // sonata_user_security_check
                if ($pathinfo === '/login_check') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::checkAction',  '_route' => 'sonata_user_security_check',);
                }

            }

            // sonata_user_security_logout
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\SecurityFOSUser1Controller::logoutAction',  '_route' => 'sonata_user_security_logout',);
            }

        }

        if (0 === strpos($pathinfo, '/resetting')) {
            // fos_user_resetting_request
            if ($pathinfo === '/resetting/request') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_request;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::requestAction',  '_route' => 'fos_user_resetting_request',);
            }
            not_fos_user_resetting_request:

            // fos_user_resetting_send_email
            if ($pathinfo === '/resetting/send-email') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fos_user_resetting_send_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
            }
            not_fos_user_resetting_send_email:

            // fos_user_resetting_check_email
            if ($pathinfo === '/resetting/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_check_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
            }
            not_fos_user_resetting_check_email:

            if (0 === strpos($pathinfo, '/resetting/re')) {
                // fos_user_resetting_reset
                if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_resetting_reset;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::resetAction',));
                }
                not_fos_user_resetting_reset:

                // sonata_user_resetting_request
                if ($pathinfo === '/resetting/request') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_sonata_user_resetting_request;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::requestAction',  '_route' => 'sonata_user_resetting_request',);
                }
                not_sonata_user_resetting_request:

            }

            // sonata_user_resetting_send_email
            if ($pathinfo === '/resetting/send-email') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_sonata_user_resetting_send_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::sendEmailAction',  '_route' => 'sonata_user_resetting_send_email',);
            }
            not_sonata_user_resetting_send_email:

            // sonata_user_resetting_check_email
            if ($pathinfo === '/resetting/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_sonata_user_resetting_check_email;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::checkEmailAction',  '_route' => 'sonata_user_resetting_check_email',);
            }
            not_sonata_user_resetting_check_email:

            // sonata_user_resetting_reset
            if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_sonata_user_resetting_reset;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_user_resetting_reset')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ResettingFOSUser1Controller::resetAction',));
            }
            not_sonata_user_resetting_reset:

        }

        if (0 === strpos($pathinfo, '/profile')) {
            // fos_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_profile_show');
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::showAction',  '_route' => 'fos_user_profile_show',);
            }
            not_fos_user_profile_show:

            if (0 === strpos($pathinfo, '/profile/edit-')) {
                // fos_user_profile_edit_authentication
                if ($pathinfo === '/profile/edit-authentication') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editAuthenticationAction',  '_route' => 'fos_user_profile_edit_authentication',);
                }

                // fos_user_profile_edit
                if ($pathinfo === '/profile/edit-profile') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editProfileAction',  '_route' => 'fos_user_profile_edit',);
                }

            }

            // sonata_user_profile_show
            if (rtrim($pathinfo, '/') === '/profile') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_sonata_user_profile_show;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'sonata_user_profile_show');
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::showAction',  '_route' => 'sonata_user_profile_show',);
            }
            not_sonata_user_profile_show:

            if (0 === strpos($pathinfo, '/profile/edit-')) {
                // sonata_user_profile_edit_authentication
                if ($pathinfo === '/profile/edit-authentication') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editAuthenticationAction',  '_route' => 'sonata_user_profile_edit_authentication',);
                }

                // sonata_user_profile_edit
                if ($pathinfo === '/profile/edit-profile') {
                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ProfileFOSUser1Controller::editProfileAction',  '_route' => 'sonata_user_profile_edit',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/register')) {
            // fos_user_registration_register
            if (rtrim($pathinfo, '/') === '/register') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'fos_user_registration_register');
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::registerAction',  '_route' => 'fos_user_registration_register',);
            }

            if (0 === strpos($pathinfo, '/register/c')) {
                // fos_user_registration_check_email
                if ($pathinfo === '/register/check-email') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_fos_user_registration_check_email;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
                }
                not_fos_user_registration_check_email:

                if (0 === strpos($pathinfo, '/register/confirm')) {
                    // fos_user_registration_confirm
                    if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_fos_user_registration_confirm;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_confirm')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmAction',));
                    }
                    not_fos_user_registration_confirm:

                    // fos_user_registration_confirmed
                    if ($pathinfo === '/register/confirmed') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_fos_user_registration_confirmed;
                        }

                        return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
                    }
                    not_fos_user_registration_confirmed:

                }

            }

            // sonata_user_registration_register
            if (rtrim($pathinfo, '/') === '/register') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'sonata_user_registration_register');
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::registerAction',  '_route' => 'sonata_user_registration_register',);
            }

            if (0 === strpos($pathinfo, '/register/c')) {
                // sonata_user_registration_check_email
                if ($pathinfo === '/register/check-email') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_sonata_user_registration_check_email;
                    }

                    return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::checkEmailAction',  '_route' => 'sonata_user_registration_check_email',);
                }
                not_sonata_user_registration_check_email:

                if (0 === strpos($pathinfo, '/register/confirm')) {
                    // sonata_user_registration_confirm
                    if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_sonata_user_registration_confirm;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_user_registration_confirm')), array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmAction',));
                    }
                    not_sonata_user_registration_confirm:

                    // sonata_user_registration_confirmed
                    if ($pathinfo === '/register/confirmed') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_sonata_user_registration_confirmed;
                        }

                        return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\RegistrationFOSUser1Controller::confirmedAction',  '_route' => 'sonata_user_registration_confirmed',);
                    }
                    not_sonata_user_registration_confirmed:

                }

            }

        }

        if (0 === strpos($pathinfo, '/profile/change-password')) {
            // fos_user_change_password
            if ($pathinfo === '/profile/change-password') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_change_password;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ChangePasswordFOSUser1Controller::changePasswordAction',  '_route' => 'fos_user_change_password',);
            }
            not_fos_user_change_password:

            // sonata_user_change_password
            if ($pathinfo === '/profile/change-password') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_sonata_user_change_password;
                }

                return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\ChangePasswordFOSUser1Controller::changePasswordAction',  '_route' => 'sonata_user_change_password',);
            }
            not_sonata_user_change_password:

        }

        if (0 === strpos($pathinfo, '/sonata')) {
            if (0 === strpos($pathinfo, '/sonata/cache')) {
                // sonata_cache_esi
                if (0 === strpos($pathinfo, '/sonata/cache/esi') && preg_match('#^/sonata/cache/esi/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_cache_esi')), array (  '_controller' => 'sonata.cache.esi:cacheAction',));
                }

                // sonata_cache_ssi
                if (0 === strpos($pathinfo, '/sonata/cache/ssi') && preg_match('#^/sonata/cache/ssi/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_cache_ssi')), array (  '_controller' => 'sonata.cache.ssi:cacheAction',));
                }

                if (0 === strpos($pathinfo, '/sonata/cache/js-')) {
                    // sonata_cache_js_async
                    if ($pathinfo === '/sonata/cache/js-async') {
                        return array (  '_controller' => 'sonata.cache.js_async:cacheAction',  '_route' => 'sonata_cache_js_async',);
                    }

                    // sonata_cache_js_sync
                    if ($pathinfo === '/sonata/cache/js-sync') {
                        return array (  '_controller' => 'sonata.cache.js_sync:cacheAction',  '_route' => 'sonata_cache_js_sync',);
                    }

                }

                // sonata_cache_apc
                if (0 === strpos($pathinfo, '/sonata/cache/apc') && preg_match('#^/sonata/cache/apc/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_cache_apc')), array (  '_controller' => 'sonata.cache.apc:cacheAction',));
                }

                // sonata_cache_symfony
                if (0 === strpos($pathinfo, '/sonata/cache/symfony') && preg_match('#^/sonata/cache/symfony/(?P<token>[^/]++)/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_cache_symfony')), array (  '_controller' => 'sonata.cache.symfony:cacheAction',));
                }

            }

            if (0 === strpos($pathinfo, '/sonata/page/cache')) {
                // sonata_page_cache_esi
                if (0 === strpos($pathinfo, '/sonata/page/cache/esi') && preg_match('#^/sonata/page/cache/esi/(?P<_token>[^/]++)/(?P<manager>[^/]++)/(?P<page_id>[^/]++)/(?P<block_id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_page_cache_esi')), array (  '_controller' => 'sonata.page.cache.esi:cacheAction',));
                }

                // sonata_page_cache_ssi
                if (0 === strpos($pathinfo, '/sonata/page/cache/ssi') && preg_match('#^/sonata/page/cache/ssi/(?P<_token>[^/]++)/(?P<manager>[^/]++)/(?P<page_id>[^/]++)/(?P<block_id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_page_cache_ssi')), array (  '_controller' => 'sonata.page.cache.ssi:cacheAction',));
                }

                if (0 === strpos($pathinfo, '/sonata/page/cache/js-')) {
                    // sonata_page_js_async_cache
                    if ($pathinfo === '/sonata/page/cache/js-async') {
                        return array (  '_controller' => 'sonata.page.cache.js_async:cacheAction',  '_route' => 'sonata_page_js_async_cache',);
                    }

                    // sonata_page_js_sync_cache
                    if ($pathinfo === '/sonata/page/cache/js-sync') {
                        return array (  '_controller' => 'sonata.page.cache.js_sync:cacheAction',  '_route' => 'sonata_page_js_sync_cache',);
                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/page/exceptions')) {
            // sonata_page_exceptions_list
            if ($pathinfo === '/page/exceptions/list') {
                return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\PageController::exceptionsListAction',  '_route' => 'sonata_page_exceptions_list',);
            }

            // sonata_page_exceptions_edit
            if (0 === strpos($pathinfo, '/page/exceptions/edit') && preg_match('#^/page/exceptions/edit/(?P<code>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_page_exceptions_edit')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\PageController::exceptionEditAction',));
            }

        }

        if (0 === strpos($pathinfo, '/media')) {
            if (0 === strpos($pathinfo, '/media/gallery')) {
                // sonata_media_gallery_index
                if (rtrim($pathinfo, '/') === '/media/gallery') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'sonata_media_gallery_index');
                    }

                    return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryController::indexAction',  '_route' => 'sonata_media_gallery_index',);
                }

                // sonata_media_gallery_view
                if (0 === strpos($pathinfo, '/media/gallery/view') && preg_match('#^/media/gallery/view/(?P<id>.*)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_media_gallery_view')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryController::viewAction',));
                }

            }

            // sonata_media_view
            if (0 === strpos($pathinfo, '/media/view') && preg_match('#^/media/view/(?P<id>[^/]++)(?:/(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_media_view')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaController::viewAction',  'format' => 'reference',));
            }

            // sonata_media_download
            if (0 === strpos($pathinfo, '/media/download') && preg_match('#^/media/download/(?P<id>.*)(?:/(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_media_download')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaController::downloadAction',  'format' => 'reference',));
            }

        }

        if (0 === strpos($pathinfo, '/shop')) {
            if (0 === strpos($pathinfo, '/shop/user/address')) {
                // sonata_customer_addresses
                if ($pathinfo === '/shop/user/address') {
                    return array (  '_controller' => 'Sonata\\CustomerBundle\\Controller\\CustomerController::addressesAction',  '_route' => 'sonata_customer_addresses',);
                }

                // sonata_customer_address_add
                if ($pathinfo === '/shop/user/address/add') {
                    return array (  '_controller' => 'Sonata\\CustomerBundle\\Controller\\CustomerController::addAddressAction',  '_route' => 'sonata_customer_address_add',);
                }

                // sonata_customer_address_delete
                if (0 === strpos($pathinfo, '/shop/user/address/delete') && preg_match('#^/shop/user/address/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_customer_address_delete')), array (  '_controller' => 'Sonata\\CustomerBundle\\Controller\\CustomerController::deleteAddressAction',));
                }

                // sonata_customer_address_setcurrent
                if (0 === strpos($pathinfo, '/shop/user/address/current') && preg_match('#^/shop/user/address/current/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_customer_address_setcurrent')), array (  '_controller' => 'Sonata\\CustomerBundle\\Controller\\CustomerController::setCurrentAddressAction',));
                }

                // sonata_customer_address_edit
                if (0 === strpos($pathinfo, '/shop/user/address/edit') && preg_match('#^/shop/user/address/edit/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_customer_address_edit')), array (  '_controller' => 'Sonata\\CustomerBundle\\Controller\\CustomerController::editAddressAction',));
                }

                // sonata_customer_address_update
                if ($pathinfo === '/shop/user/address/update') {
                    return array (  '_controller' => 'Sonata\\CustomerBundle\\Controller\\CustomerController::updateAddressAction',  '_route' => 'sonata_customer_address_update',);
                }

            }

            if (0 === strpos($pathinfo, '/shop/basket')) {
                // sonata_basket_index
                if (rtrim($pathinfo, '/') === '/shop/basket') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'sonata_basket_index');
                    }

                    return array (  '_controller' => 'Sonata\\BasketBundle\\Controller\\BasketController::indexAction',  '_route' => 'sonata_basket_index',);
                }

                // sonata_basket_add_product
                if ($pathinfo === '/shop/basket/add-product') {
                    return array (  '_controller' => 'Sonata\\BasketBundle\\Controller\\BasketController::addProductAction',  '_route' => 'sonata_basket_add_product',);
                }

                // sonata_basket_update
                if ($pathinfo === '/shop/basket/update') {
                    return array (  '_controller' => 'Sonata\\BasketBundle\\Controller\\BasketController::updateAction',  '_route' => 'sonata_basket_update',);
                }

                // sonata_basket_reset
                if ($pathinfo === '/shop/basket/reset') {
                    return array (  '_controller' => 'Sonata\\BasketBundle\\Controller\\BasketController::resetAction',  '_route' => 'sonata_basket_reset',);
                }

                if (0 === strpos($pathinfo, '/shop/basket/step')) {
                    // sonata_basket_authentication
                    if ($pathinfo === '/shop/basket/step/authentication') {
                        return array (  '_controller' => 'Sonata\\BasketBundle\\Controller\\BasketController::authenticationStepAction',  '_route' => 'sonata_basket_authentication',);
                    }

                    if (0 === strpos($pathinfo, '/shop/basket/step/delivery')) {
                        // sonata_basket_delivery_address
                        if ($pathinfo === '/shop/basket/step/delivery/address') {
                            return array (  '_controller' => 'Sonata\\BasketBundle\\Controller\\BasketController::deliveryAddressStepAction',  '_route' => 'sonata_basket_delivery_address',);
                        }

                        // sonata_basket_delivery
                        if ($pathinfo === '/shop/basket/step/delivery') {
                            return array (  '_controller' => 'Sonata\\BasketBundle\\Controller\\BasketController::deliveryStepAction',  '_route' => 'sonata_basket_delivery',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/shop/basket/step/payment')) {
                        // sonata_basket_payment_address
                        if ($pathinfo === '/shop/basket/step/payment/address') {
                            return array (  '_controller' => 'Sonata\\BasketBundle\\Controller\\BasketController::paymentAddressStepAction',  '_route' => 'sonata_basket_payment_address',);
                        }

                        // sonata_basket_payment
                        if ($pathinfo === '/shop/basket/step/payment') {
                            return array (  '_controller' => 'Sonata\\BasketBundle\\Controller\\BasketController::paymentStepAction',  '_route' => 'sonata_basket_payment',);
                        }

                    }

                    // sonata_basket_final
                    if ($pathinfo === '/shop/basket/step/final-review') {
                        return array (  '_controller' => 'Sonata\\BasketBundle\\Controller\\BasketController::finalReviewStepAction',  '_route' => 'sonata_basket_final',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/shop/user/order')) {
                // sonata_order_index
                if (rtrim($pathinfo, '/') === '/shop/user/order') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'sonata_order_index');
                    }

                    return array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderController::indexAction',  '_route' => 'sonata_order_index',);
                }

                // sonata_order_view
                if (preg_match('#^/shop/user/order/(?P<reference>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_order_view')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderController::viewAction',));
                }

                // sonata_order_download
                if (preg_match('#^/shop/user/order/(?P<reference>[^/]++)/download$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_order_download')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderController::viewAction',));
                }

            }

            if (0 === strpos($pathinfo, '/shop/catalog')) {
                // sonata_catalog_index
                if (rtrim($pathinfo, '/') === '/shop/catalog') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'sonata_catalog_index');
                    }

                    return array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\CatalogController::indexAction',  '_route' => 'sonata_catalog_index',);
                }

                // sonata_catalog_category
                if (preg_match('#^/shop/catalog(?:/(?P<category_slug>[^/]++)(?:/(?P<category_id>[^/]++))?)?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_catalog_category')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\CatalogController::indexAction',  'category_id' => '0',  'category_slug' => 'all',));
                }

            }

            if (0 === strpos($pathinfo, '/shop/p')) {
                if (0 === strpos($pathinfo, '/shop/product')) {
                    // sonata_product_price_stock
                    if (preg_match('#^/shop/product/(?P<productId>[^/]++)/info$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_product_price_stock')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductController::getPriceStockForQuantityAction',));
                    }

                    // sonata_product_view
                    if (preg_match('#^/shop/product/(?P<slug>[^/]++)/(?P<productId>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_product_view')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductController::viewAction',));
                    }

                    // sonata_product_view_variations
                    if (preg_match('#^/shop/product/(?P<slug>[^/]++)/(?P<productId>[^/]++)/variations$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_product_view_variations')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductController::viewVariationsAction',));
                    }

                    // sonata_product_variation_product
                    if (preg_match('#^/shop/product/(?P<slug>[^/]++)/(?P<productId>[^/]++)/variation$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_product_variation_product')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductController::variationToProductAction',));
                    }

                }

                if (0 === strpos($pathinfo, '/shop/payment')) {
                    // sonata_payment_confirmation
                    if ($pathinfo === '/shop/payment/confirmation') {
                        return array (  '_controller' => 'Sonata\\PaymentBundle\\Controller\\PaymentController::confirmationAction',  '_route' => 'sonata_payment_confirmation',);
                    }

                    // sonata_payment_error
                    if ($pathinfo === '/shop/payment/error') {
                        return array (  '_controller' => 'Sonata\\PaymentBundle\\Controller\\PaymentController::errorAction',  '_route' => 'sonata_payment_error',);
                    }

                    // sonata_payment_sendbank
                    if ($pathinfo === '/shop/payment/sendbank') {
                        return array (  '_controller' => 'Sonata\\PaymentBundle\\Controller\\PaymentController::sendbankAction',  '_route' => 'sonata_payment_sendbank',);
                    }

                    // sonata_payment_callback
                    if ($pathinfo === '/shop/payment/callback') {
                        return array (  '_controller' => 'Sonata\\PaymentBundle\\Controller\\PaymentController::callbackAction',  '_route' => 'sonata_payment_callback',);
                    }

                    // sonata_payment_terms
                    if ($pathinfo === '/shop/payment/terms-and-conditions') {
                        return array (  '_controller' => 'Sonata\\PaymentBundle\\Controller\\PaymentController::termsAction',  '_route' => 'sonata_payment_terms',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/shop/user/invoice')) {
                // sonata_invoice_index
                if (rtrim($pathinfo, '/') === '/shop/user/invoice') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'sonata_invoice_index');
                    }

                    return array (  '_controller' => 'Sonata\\InvoiceBundle\\Controller\\InvoiceController::indexAction',  '_route' => 'sonata_invoice_index',);
                }

                // sonata_invoice_view
                if (preg_match('#^/shop/user/invoice/(?P<reference>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_invoice_view')), array (  '_controller' => 'Sonata\\InvoiceBundle\\Controller\\InvoiceController::viewAction',));
                }

                // sonata_invoice_download
                if (preg_match('#^/shop/user/invoice/(?P<reference>[^/]++)/download$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_invoice_download')), array (  '_controller' => 'Sonata\\InvoiceBundle\\Controller\\InvoiceController::downloadAction',));
                }

            }

        }

        if (0 === strpos($pathinfo, '/blog')) {
            if (0 === strpos($pathinfo, '/blog/a')) {
                // sonata_news_add_comment
                if (0 === strpos($pathinfo, '/blog/add-comment') && preg_match('#^/blog/add\\-comment/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_news_add_comment')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\PostController::addCommentAction',));
                }

                // sonata_news_archive_monthly
                if (0 === strpos($pathinfo, '/blog/archive') && preg_match('#^/blog/archive/(?P<year>\\d+)/(?P<month>\\d+)(?:\\.(?P<_format>html|rss))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_news_archive_monthly')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\PostController::archiveMonthlyAction',  '_format' => 'html',));
                }

            }

            // sonata_news_tag
            if (0 === strpos($pathinfo, '/blog/tag') && preg_match('#^/blog/tag/(?P<tag>[^/\\.]++)(?:\\.(?P<_format>html|rss))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_news_tag')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\PostController::tagAction',  '_format' => 'html',));
            }

            // sonata_news_collection
            if (0 === strpos($pathinfo, '/blog/collection') && preg_match('#^/blog/collection/(?P<collection>[^/\\.]++)(?:\\.(?P<_format>html|rss))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_news_collection')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\PostController::collectionAction',  '_format' => 'html',));
            }

            if (0 === strpos($pathinfo, '/blog/archive')) {
                // sonata_news_archive_yearly
                if (preg_match('#^/blog/archive/(?P<year>\\d+)(?:\\.(?P<_format>html|rss))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_news_archive_yearly')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\PostController::archiveYearlyAction',  '_format' => 'html',));
                }

                // sonata_news_archive
                if (preg_match('#^/blog/archive(?:\\.(?P<_format>html|rss))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_news_archive')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\PostController::archiveAction',  '_format' => 'html',));
                }

            }

            // sonata_news_comment_moderation
            if (0 === strpos($pathinfo, '/blog/comment/moderation') && preg_match('#^/blog/comment/moderation/(?P<commentId>[^/]++)/(?P<hash>[^/]++)/(?P<status>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_news_comment_moderation')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\PostController::commentModerationAction',));
            }

            // sonata_news_view
            if (preg_match('#^/blog/(?P<permalink>.+?)(?:\\.(?P<_format>html|rss))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_news_view')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\PostController::viewAction',  '_format' => 'html',));
            }

            // sonata_news_home
            if (rtrim($pathinfo, '/') === '/blog') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'sonata_news_home');
                }

                return array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\PostController::homeAction',  '_route' => 'sonata_news_home',);
            }

        }

        if (0 === strpos($pathinfo, '/comments/threads')) {
            // fos_comment_new_threads
            if (0 === strpos($pathinfo, '/comments/threads/new') && preg_match('#^/comments/threads/new(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_comment_new_threads;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_new_threads')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::newThreadsAction',  '_format' => 'html',));
            }
            not_fos_comment_new_threads:

            // fos_comment_edit_thread_commentable
            if (preg_match('#^/comments/threads/(?P<id>[^/]++)/commentable/edit(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_comment_edit_thread_commentable;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_edit_thread_commentable')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::editThreadCommentableAction',  '_format' => 'html',));
            }
            not_fos_comment_edit_thread_commentable:

            // fos_comment_new_thread_comments
            if (preg_match('#^/comments/threads/(?P<id>[^/]++)/comments/new(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_comment_new_thread_comments;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_new_thread_comments')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::newThreadCommentsAction',  '_format' => 'html',));
            }
            not_fos_comment_new_thread_comments:

            // fos_comment_remove_thread_comment
            if (preg_match('#^/comments/threads/(?P<id>[^/]++)/comments/(?P<commentId>[^/]++)/remove(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_comment_remove_thread_comment;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_remove_thread_comment')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::removeThreadCommentAction',  '_format' => 'html',));
            }
            not_fos_comment_remove_thread_comment:

            // fos_comment_edit_thread_comment
            if (preg_match('#^/comments/threads/(?P<id>[^/]++)/comments/(?P<commentId>[^/]++)/edit(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_comment_edit_thread_comment;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_edit_thread_comment')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::editThreadCommentAction',  '_format' => 'html',));
            }
            not_fos_comment_edit_thread_comment:

            // fos_comment_new_thread_comment_votes
            if (preg_match('#^/comments/threads/(?P<id>[^/]++)/comments/(?P<commentId>[^/]++)/votes/new(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_comment_new_thread_comment_votes;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_new_thread_comment_votes')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::newThreadCommentVotesAction',  '_format' => 'html',));
            }
            not_fos_comment_new_thread_comment_votes:

            // fos_comment_get_thread
            if (preg_match('#^/comments/threads/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_comment_get_thread;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_get_thread')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::getThreadAction',  '_format' => 'html',));
            }
            not_fos_comment_get_thread:

            // fos_comment_get_threads
            if (preg_match('#^/comments/threads(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_comment_get_threads;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_get_threads')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::getThreadsActions',  '_format' => 'html',));
            }
            not_fos_comment_get_threads:

            // fos_comment_post_threads
            if (preg_match('#^/comments/threads(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fos_comment_post_threads;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_post_threads')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::postThreadsAction',  '_format' => 'html',));
            }
            not_fos_comment_post_threads:

            // fos_comment_patch_thread_commentable
            if (preg_match('#^/comments/threads/(?P<id>[^/]++)/commentable(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PATCH') {
                    $allow[] = 'PATCH';
                    goto not_fos_comment_patch_thread_commentable;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_patch_thread_commentable')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::patchThreadCommentableAction',  '_format' => 'html',));
            }
            not_fos_comment_patch_thread_commentable:

            // fos_comment_get_thread_comment
            if (preg_match('#^/comments/threads/(?P<id>[^/]++)/comments/(?P<commentId>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_comment_get_thread_comment;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_get_thread_comment')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::getThreadCommentAction',  '_format' => 'html',));
            }
            not_fos_comment_get_thread_comment:

            // fos_comment_patch_thread_comment_state
            if (preg_match('#^/comments/threads/(?P<id>[^/]++)/comments/(?P<commentId>[^/]++)/state(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PATCH') {
                    $allow[] = 'PATCH';
                    goto not_fos_comment_patch_thread_comment_state;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_patch_thread_comment_state')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::patchThreadCommentStateAction',  '_format' => 'html',));
            }
            not_fos_comment_patch_thread_comment_state:

            // fos_comment_put_thread_comments
            if (preg_match('#^/comments/threads/(?P<id>[^/]++)/comments/(?P<commentId>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'PUT') {
                    $allow[] = 'PUT';
                    goto not_fos_comment_put_thread_comments;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_put_thread_comments')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::putThreadCommentsAction',  '_format' => 'html',));
            }
            not_fos_comment_put_thread_comments:

            // fos_comment_get_thread_comments
            if (preg_match('#^/comments/threads/(?P<id>[^/]++)/comments(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_comment_get_thread_comments;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_get_thread_comments')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::getThreadCommentsAction',  '_format' => 'html',));
            }
            not_fos_comment_get_thread_comments:

            // fos_comment_post_thread_comments
            if (preg_match('#^/comments/threads/(?P<id>[^/]++)/comments(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fos_comment_post_thread_comments;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_post_thread_comments')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::postThreadCommentsAction',  '_format' => 'html',));
            }
            not_fos_comment_post_thread_comments:

            // fos_comment_get_thread_comment_votes
            if (preg_match('#^/comments/threads/(?P<id>[^/]++)/comments/(?P<commentId>[^/]++)/votes(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_comment_get_thread_comment_votes;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_get_thread_comment_votes')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::getThreadCommentVotesAction',  '_format' => 'html',));
            }
            not_fos_comment_get_thread_comment_votes:

            // fos_comment_post_thread_comment_votes
            if (preg_match('#^/comments/threads/(?P<id>[^/]++)/comments/(?P<commentId>[^/]++)/votes(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fos_comment_post_thread_comment_votes;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_comment_post_thread_comment_votes')), array (  '_controller' => 'FOS\\CommentBundle\\Controller\\ThreadController::postThreadCommentVotesAction',  '_format' => 'html',));
            }
            not_fos_comment_post_thread_comment_votes:

        }

        if (0 === strpos($pathinfo, '/a')) {
            if (0 === strpos($pathinfo, '/admin')) {
                // sonata_admin_redirect
                if (rtrim($pathinfo, '/') === '/admin') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'sonata_admin_redirect');
                    }

                    return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'sonata_admin_dashboard',  'permanent' => 'true',  '_route' => 'sonata_admin_redirect',);
                }

                // sonata_admin_dashboard
                if ($pathinfo === '/admin/dashboard') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::dashboardAction',  '_route' => 'sonata_admin_dashboard',);
                }

                if (0 === strpos($pathinfo, '/admin/core')) {
                    // sonata_admin_retrieve_form_element
                    if ($pathinfo === '/admin/core/get-form-field-element') {
                        return array (  '_controller' => 'sonata.admin.controller.admin:retrieveFormFieldElementAction',  '_route' => 'sonata_admin_retrieve_form_element',);
                    }

                    // sonata_admin_append_form_element
                    if ($pathinfo === '/admin/core/append-form-field-element') {
                        return array (  '_controller' => 'sonata.admin.controller.admin:appendFormFieldElementAction',  '_route' => 'sonata_admin_append_form_element',);
                    }

                    // sonata_admin_short_object_information
                    if (0 === strpos($pathinfo, '/admin/core/get-short-object-description') && preg_match('#^/admin/core/get\\-short\\-object\\-description(?:\\.(?P<_format>html|json))?$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_admin_short_object_information')), array (  '_controller' => 'sonata.admin.controller.admin:getShortObjectDescriptionAction',  '_format' => 'html',));
                    }

                    // sonata_admin_set_object_field_value
                    if ($pathinfo === '/admin/core/set-object-field-value') {
                        return array (  '_controller' => 'sonata.admin.controller.admin:setObjectFieldValueAction',  '_route' => 'sonata_admin_set_object_field_value',);
                    }

                }

                // sonata_admin_search
                if ($pathinfo === '/admin/search') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::searchAction',  '_route' => 'sonata_admin_search',);
                }

                // sonata_admin_retrieve_autocomplete_items
                if ($pathinfo === '/admin/core/get-autocomplete-items') {
                    return array (  '_controller' => 'sonata.admin.controller.admin:retrieveAutocompleteItemsAction',  '_route' => 'sonata_admin_retrieve_autocomplete_items',);
                }

                if (0 === strpos($pathinfo, '/admin/sonata')) {
                    if (0 === strpos($pathinfo, '/admin/sonata/user')) {
                        if (0 === strpos($pathinfo, '/admin/sonata/user/user')) {
                            // admin_sonata_user_user_list
                            if ($pathinfo === '/admin/sonata/user/user/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_list',  '_route' => 'admin_sonata_user_user_list',);
                            }

                            // admin_sonata_user_user_create
                            if ($pathinfo === '/admin/sonata/user/user/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_create',  '_route' => 'admin_sonata_user_user_create',);
                            }

                            // admin_sonata_user_user_batch
                            if ($pathinfo === '/admin/sonata/user/user/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_batch',  '_route' => 'admin_sonata_user_user_batch',);
                            }

                            // admin_sonata_user_user_edit
                            if (preg_match('#^/admin/sonata/user/user/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_user_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_edit',));
                            }

                            // admin_sonata_user_user_delete
                            if (preg_match('#^/admin/sonata/user/user/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_user_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_delete',));
                            }

                            // admin_sonata_user_user_show
                            if (preg_match('#^/admin/sonata/user/user/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_user_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_show',));
                            }

                            // admin_sonata_user_user_export
                            if ($pathinfo === '/admin/sonata/user/user/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_export',  '_route' => 'admin_sonata_user_user_export',);
                            }

                            // admin_sonata_user_user_history
                            if (preg_match('#^/admin/sonata/user/user/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_user_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_history',));
                            }

                            // admin_sonata_user_user_history_view_revision
                            if (preg_match('#^/admin/sonata/user/user/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_user_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_history_view_revision',));
                            }

                            // admin_sonata_user_user_history_compare_revisions
                            if (preg_match('#^/admin/sonata/user/user/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_user_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_history_compare_revisions',));
                            }

                            // admin_sonata_user_user_acl
                            if (preg_match('#^/admin/sonata/user/user/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_user_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.user.admin.user',  '_sonata_name' => 'admin_sonata_user_user_acl',));
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/user/group')) {
                            // admin_sonata_user_group_list
                            if ($pathinfo === '/admin/sonata/user/group/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_list',  '_route' => 'admin_sonata_user_group_list',);
                            }

                            // admin_sonata_user_group_create
                            if ($pathinfo === '/admin/sonata/user/group/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_create',  '_route' => 'admin_sonata_user_group_create',);
                            }

                            // admin_sonata_user_group_batch
                            if ($pathinfo === '/admin/sonata/user/group/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_batch',  '_route' => 'admin_sonata_user_group_batch',);
                            }

                            // admin_sonata_user_group_edit
                            if (preg_match('#^/admin/sonata/user/group/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_edit',));
                            }

                            // admin_sonata_user_group_delete
                            if (preg_match('#^/admin/sonata/user/group/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_delete',));
                            }

                            // admin_sonata_user_group_show
                            if (preg_match('#^/admin/sonata/user/group/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_show',));
                            }

                            // admin_sonata_user_group_export
                            if ($pathinfo === '/admin/sonata/user/group/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_export',  '_route' => 'admin_sonata_user_group_export',);
                            }

                            // admin_sonata_user_group_history
                            if (preg_match('#^/admin/sonata/user/group/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_history',));
                            }

                            // admin_sonata_user_group_history_view_revision
                            if (preg_match('#^/admin/sonata/user/group/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_history_view_revision',));
                            }

                            // admin_sonata_user_group_history_compare_revisions
                            if (preg_match('#^/admin/sonata/user/group/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_history_compare_revisions',));
                            }

                            // admin_sonata_user_group_acl
                            if (preg_match('#^/admin/sonata/user/group/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_user_group_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.user.admin.group',  '_sonata_name' => 'admin_sonata_user_group_acl',));
                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/sonata/page')) {
                        if (0 === strpos($pathinfo, '/admin/sonata/page/page')) {
                            // admin_sonata_page_page_list
                            if ($pathinfo === '/admin/sonata/page/page/list') {
                                return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\PageAdminController::listAction',  '_sonata_admin' => 'sonata.page.admin.page',  '_sonata_name' => 'admin_sonata_page_page_list',  '_route' => 'admin_sonata_page_page_list',);
                            }

                            // admin_sonata_page_page_create
                            if ($pathinfo === '/admin/sonata/page/page/create') {
                                return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\PageAdminController::createAction',  '_sonata_admin' => 'sonata.page.admin.page',  '_sonata_name' => 'admin_sonata_page_page_create',  '_route' => 'admin_sonata_page_page_create',);
                            }

                            // admin_sonata_page_page_batch
                            if ($pathinfo === '/admin/sonata/page/page/batch') {
                                return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\PageAdminController::batchAction',  '_sonata_admin' => 'sonata.page.admin.page',  '_sonata_name' => 'admin_sonata_page_page_batch',  '_route' => 'admin_sonata_page_page_batch',);
                            }

                            // admin_sonata_page_page_edit
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_edit')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\PageAdminController::editAction',  '_sonata_admin' => 'sonata.page.admin.page',  '_sonata_name' => 'admin_sonata_page_page_edit',));
                            }

                            // admin_sonata_page_page_delete
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_delete')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\PageAdminController::deleteAction',  '_sonata_admin' => 'sonata.page.admin.page',  '_sonata_name' => 'admin_sonata_page_page_delete',));
                            }

                            // admin_sonata_page_page_show
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_show')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\PageAdminController::showAction',  '_sonata_admin' => 'sonata.page.admin.page',  '_sonata_name' => 'admin_sonata_page_page_show',));
                            }

                            // admin_sonata_page_page_export
                            if ($pathinfo === '/admin/sonata/page/page/export') {
                                return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\PageAdminController::exportAction',  '_sonata_admin' => 'sonata.page.admin.page',  '_sonata_name' => 'admin_sonata_page_page_export',  '_route' => 'admin_sonata_page_page_export',);
                            }

                            // admin_sonata_page_page_history
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_history')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\PageAdminController::historyAction',  '_sonata_admin' => 'sonata.page.admin.page',  '_sonata_name' => 'admin_sonata_page_page_history',));
                            }

                            // admin_sonata_page_page_history_view_revision
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_history_view_revision')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\PageAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.page.admin.page',  '_sonata_name' => 'admin_sonata_page_page_history_view_revision',));
                            }

                            // admin_sonata_page_page_history_compare_revisions
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_history_compare_revisions')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\PageAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.page.admin.page',  '_sonata_name' => 'admin_sonata_page_page_history_compare_revisions',));
                            }

                            // admin_sonata_page_page_acl
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_acl')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\PageAdminController::aclAction',  '_sonata_admin' => 'sonata.page.admin.page',  '_sonata_name' => 'admin_sonata_page_page_acl',));
                            }

                            // admin_sonata_page_page_block_list
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/list$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_list')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::listAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_list',));
                            }

                            // admin_sonata_page_page_block_create
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/create$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_create')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::createAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_create',));
                            }

                            // admin_sonata_page_page_block_batch
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/batch$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_batch')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::batchAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_batch',));
                            }

                            // admin_sonata_page_page_block_edit
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/(?P<childId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_edit')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::editAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_edit',));
                            }

                            // admin_sonata_page_page_block_delete
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/(?P<childId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_delete')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::deleteAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_delete',));
                            }

                            // admin_sonata_page_page_block_show
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/(?P<childId>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_show')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::showAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_show',));
                            }

                            // admin_sonata_page_page_block_export
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/export$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_export')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::exportAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_export',));
                            }

                            // admin_sonata_page_page_block_history
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/(?P<childId>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_history')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::historyAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_history',));
                            }

                            // admin_sonata_page_page_block_history_view_revision
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/(?P<childId>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_history_view_revision')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_history_view_revision',));
                            }

                            // admin_sonata_page_page_block_history_compare_revisions
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/(?P<childId>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_history_compare_revisions')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_history_compare_revisions',));
                            }

                            // admin_sonata_page_page_block_acl
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/(?P<childId>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_acl')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::aclAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_acl',));
                            }

                            // admin_sonata_page_page_block_view
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/(?P<childId>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_view')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::viewAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_view',));
                            }

                            // admin_sonata_page_page_block_savePosition
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/save\\-position$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_savePosition')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::savePositionAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_savePosition',));
                            }

                            // admin_sonata_page_page_block_switchParent
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/switch\\-parent$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_switchParent')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::switchParentAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_switchParent',));
                            }

                            // admin_sonata_page_page_block_composePreview
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/block/(?P<block_id>[^/]++)/compose_preview$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_block_composePreview')), array (  'block_id' => NULL,  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::composePreviewAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_page_block_composePreview',));
                            }

                            // admin_sonata_page_page_snapshot_list
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/snapshot/list$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_snapshot_list')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::listAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_page_snapshot_list',));
                            }

                            // admin_sonata_page_page_snapshot_create
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/snapshot/create$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_snapshot_create')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::createAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_page_snapshot_create',));
                            }

                            // admin_sonata_page_page_snapshot_batch
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/snapshot/batch$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_snapshot_batch')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::batchAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_page_snapshot_batch',));
                            }

                            // admin_sonata_page_page_snapshot_edit
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/snapshot/(?P<childId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_snapshot_edit')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::editAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_page_snapshot_edit',));
                            }

                            // admin_sonata_page_page_snapshot_delete
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/snapshot/(?P<childId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_snapshot_delete')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::deleteAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_page_snapshot_delete',));
                            }

                            // admin_sonata_page_page_snapshot_show
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/snapshot/(?P<childId>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_snapshot_show')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::showAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_page_snapshot_show',));
                            }

                            // admin_sonata_page_page_snapshot_export
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/snapshot/export$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_snapshot_export')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::exportAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_page_snapshot_export',));
                            }

                            // admin_sonata_page_page_snapshot_history
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/snapshot/(?P<childId>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_snapshot_history')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::historyAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_page_snapshot_history',));
                            }

                            // admin_sonata_page_page_snapshot_history_view_revision
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/snapshot/(?P<childId>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_snapshot_history_view_revision')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_page_snapshot_history_view_revision',));
                            }

                            // admin_sonata_page_page_snapshot_history_compare_revisions
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/snapshot/(?P<childId>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_snapshot_history_compare_revisions')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_page_snapshot_history_compare_revisions',));
                            }

                            // admin_sonata_page_page_snapshot_acl
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/snapshot/(?P<childId>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_snapshot_acl')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::aclAction',  '_sonata_admin' => 'sonata.page.admin.page|sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_page_snapshot_acl',));
                            }

                            // admin_sonata_page_page_compose
                            if (preg_match('#^/admin/sonata/page/page/(?P<id>[^/]++)/compose$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_compose')), array (  'id' => NULL,  '_controller' => 'Sonata\\PageBundle\\Controller\\PageAdminController::composeAction',  '_sonata_admin' => 'sonata.page.admin.page',  '_sonata_name' => 'admin_sonata_page_page_compose',));
                            }

                            // admin_sonata_page_page_compose_container_show
                            if (0 === strpos($pathinfo, '/admin/sonata/page/page/compose/container') && preg_match('#^/admin/sonata/page/page/compose/container(?:/(?P<id>[^/]++))?$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_page_compose_container_show')), array (  'id' => NULL,  '_controller' => 'Sonata\\PageBundle\\Controller\\PageAdminController::composeContainerShowAction',  '_sonata_admin' => 'sonata.page.admin.page',  '_sonata_name' => 'admin_sonata_page_page_compose_container_show',));
                            }

                            // admin_sonata_page_page_tree
                            if ($pathinfo === '/admin/sonata/page/page/tree') {
                                return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\PageAdminController::treeAction',  '_sonata_admin' => 'sonata.page.admin.page',  '_sonata_name' => 'admin_sonata_page_page_tree',  '_route' => 'admin_sonata_page_page_tree',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/page/block')) {
                            // admin_sonata_page_block_list
                            if ($pathinfo === '/admin/sonata/page/block/list') {
                                return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::listAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_list',  '_route' => 'admin_sonata_page_block_list',);
                            }

                            // admin_sonata_page_block_create
                            if ($pathinfo === '/admin/sonata/page/block/create') {
                                return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::createAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_create',  '_route' => 'admin_sonata_page_block_create',);
                            }

                            // admin_sonata_page_block_batch
                            if ($pathinfo === '/admin/sonata/page/block/batch') {
                                return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::batchAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_batch',  '_route' => 'admin_sonata_page_block_batch',);
                            }

                            // admin_sonata_page_block_edit
                            if (preg_match('#^/admin/sonata/page/block/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block_edit')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::editAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_edit',));
                            }

                            // admin_sonata_page_block_delete
                            if (preg_match('#^/admin/sonata/page/block/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block_delete')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::deleteAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_delete',));
                            }

                            // admin_sonata_page_block_show
                            if (preg_match('#^/admin/sonata/page/block/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block_show')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::showAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_show',));
                            }

                            // admin_sonata_page_block_export
                            if ($pathinfo === '/admin/sonata/page/block/export') {
                                return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::exportAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_export',  '_route' => 'admin_sonata_page_block_export',);
                            }

                            // admin_sonata_page_block_history
                            if (preg_match('#^/admin/sonata/page/block/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block_history')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::historyAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_history',));
                            }

                            // admin_sonata_page_block_history_view_revision
                            if (preg_match('#^/admin/sonata/page/block/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block_history_view_revision')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_history_view_revision',));
                            }

                            // admin_sonata_page_block_history_compare_revisions
                            if (preg_match('#^/admin/sonata/page/block/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block_history_compare_revisions')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_history_compare_revisions',));
                            }

                            // admin_sonata_page_block_acl
                            if (preg_match('#^/admin/sonata/page/block/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block_acl')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::aclAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_acl',));
                            }

                            // admin_sonata_page_block_view
                            if (preg_match('#^/admin/sonata/page/block/(?P<id>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block_view')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::viewAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_view',));
                            }

                            if (0 === strpos($pathinfo, '/admin/sonata/page/block/s')) {
                                // admin_sonata_page_block_savePosition
                                if ($pathinfo === '/admin/sonata/page/block/save-position') {
                                    return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::savePositionAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_savePosition',  '_route' => 'admin_sonata_page_block_savePosition',);
                                }

                                // admin_sonata_page_block_switchParent
                                if ($pathinfo === '/admin/sonata/page/block/switch-parent') {
                                    return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::switchParentAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_switchParent',  '_route' => 'admin_sonata_page_block_switchParent',);
                                }

                            }

                            // admin_sonata_page_block_composePreview
                            if (preg_match('#^/admin/sonata/page/block/(?P<block_id>[^/]++)/compose_preview$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block_composePreview')), array (  'block_id' => NULL,  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::composePreviewAction',  '_sonata_admin' => 'sonata.page.admin.block',  '_sonata_name' => 'admin_sonata_page_block_composePreview',));
                            }

                            if (0 === strpos($pathinfo, '/admin/sonata/page/block/shared')) {
                                // admin_sonata_page_block/shared_list
                                if ($pathinfo === '/admin/sonata/page/block/shared/list') {
                                    return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::listAction',  '_sonata_admin' => 'sonata.page.admin.shared_block',  '_sonata_name' => 'admin_sonata_page_block/shared_list',  '_route' => 'admin_sonata_page_block/shared_list',);
                                }

                                // admin_sonata_page_block/shared_create
                                if ($pathinfo === '/admin/sonata/page/block/shared/create') {
                                    return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::createAction',  '_sonata_admin' => 'sonata.page.admin.shared_block',  '_sonata_name' => 'admin_sonata_page_block/shared_create',  '_route' => 'admin_sonata_page_block/shared_create',);
                                }

                                // admin_sonata_page_block/shared_batch
                                if ($pathinfo === '/admin/sonata/page/block/shared/batch') {
                                    return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::batchAction',  '_sonata_admin' => 'sonata.page.admin.shared_block',  '_sonata_name' => 'admin_sonata_page_block/shared_batch',  '_route' => 'admin_sonata_page_block/shared_batch',);
                                }

                                // admin_sonata_page_block/shared_edit
                                if (preg_match('#^/admin/sonata/page/block/shared/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block/shared_edit')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::editAction',  '_sonata_admin' => 'sonata.page.admin.shared_block',  '_sonata_name' => 'admin_sonata_page_block/shared_edit',));
                                }

                                // admin_sonata_page_block/shared_delete
                                if (preg_match('#^/admin/sonata/page/block/shared/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block/shared_delete')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::deleteAction',  '_sonata_admin' => 'sonata.page.admin.shared_block',  '_sonata_name' => 'admin_sonata_page_block/shared_delete',));
                                }

                                // admin_sonata_page_block/shared_show
                                if (preg_match('#^/admin/sonata/page/block/shared/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block/shared_show')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::showAction',  '_sonata_admin' => 'sonata.page.admin.shared_block',  '_sonata_name' => 'admin_sonata_page_block/shared_show',));
                                }

                                // admin_sonata_page_block/shared_export
                                if ($pathinfo === '/admin/sonata/page/block/shared/export') {
                                    return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::exportAction',  '_sonata_admin' => 'sonata.page.admin.shared_block',  '_sonata_name' => 'admin_sonata_page_block/shared_export',  '_route' => 'admin_sonata_page_block/shared_export',);
                                }

                                // admin_sonata_page_block/shared_history
                                if (preg_match('#^/admin/sonata/page/block/shared/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block/shared_history')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::historyAction',  '_sonata_admin' => 'sonata.page.admin.shared_block',  '_sonata_name' => 'admin_sonata_page_block/shared_history',));
                                }

                                // admin_sonata_page_block/shared_history_view_revision
                                if (preg_match('#^/admin/sonata/page/block/shared/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block/shared_history_view_revision')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.page.admin.shared_block',  '_sonata_name' => 'admin_sonata_page_block/shared_history_view_revision',));
                                }

                                // admin_sonata_page_block/shared_history_compare_revisions
                                if (preg_match('#^/admin/sonata/page/block/shared/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block/shared_history_compare_revisions')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.page.admin.shared_block',  '_sonata_name' => 'admin_sonata_page_block/shared_history_compare_revisions',));
                                }

                                // admin_sonata_page_block/shared_acl
                                if (preg_match('#^/admin/sonata/page/block/shared/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block/shared_acl')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::aclAction',  '_sonata_admin' => 'sonata.page.admin.shared_block',  '_sonata_name' => 'admin_sonata_page_block/shared_acl',));
                                }

                                // admin_sonata_page_block/shared_view
                                if (preg_match('#^/admin/sonata/page/block/shared/(?P<id>[^/]++)/view$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_block/shared_view')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\BlockAdminController::viewAction',  '_sonata_admin' => 'sonata.page.admin.shared_block',  '_sonata_name' => 'admin_sonata_page_block/shared_view',));
                                }

                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/page/s')) {
                            if (0 === strpos($pathinfo, '/admin/sonata/page/snapshot')) {
                                // admin_sonata_page_snapshot_list
                                if ($pathinfo === '/admin/sonata/page/snapshot/list') {
                                    return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::listAction',  '_sonata_admin' => 'sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_snapshot_list',  '_route' => 'admin_sonata_page_snapshot_list',);
                                }

                                // admin_sonata_page_snapshot_create
                                if ($pathinfo === '/admin/sonata/page/snapshot/create') {
                                    return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::createAction',  '_sonata_admin' => 'sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_snapshot_create',  '_route' => 'admin_sonata_page_snapshot_create',);
                                }

                                // admin_sonata_page_snapshot_batch
                                if ($pathinfo === '/admin/sonata/page/snapshot/batch') {
                                    return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::batchAction',  '_sonata_admin' => 'sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_snapshot_batch',  '_route' => 'admin_sonata_page_snapshot_batch',);
                                }

                                // admin_sonata_page_snapshot_edit
                                if (preg_match('#^/admin/sonata/page/snapshot/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_snapshot_edit')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::editAction',  '_sonata_admin' => 'sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_snapshot_edit',));
                                }

                                // admin_sonata_page_snapshot_delete
                                if (preg_match('#^/admin/sonata/page/snapshot/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_snapshot_delete')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::deleteAction',  '_sonata_admin' => 'sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_snapshot_delete',));
                                }

                                // admin_sonata_page_snapshot_show
                                if (preg_match('#^/admin/sonata/page/snapshot/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_snapshot_show')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::showAction',  '_sonata_admin' => 'sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_snapshot_show',));
                                }

                                // admin_sonata_page_snapshot_export
                                if ($pathinfo === '/admin/sonata/page/snapshot/export') {
                                    return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::exportAction',  '_sonata_admin' => 'sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_snapshot_export',  '_route' => 'admin_sonata_page_snapshot_export',);
                                }

                                // admin_sonata_page_snapshot_history
                                if (preg_match('#^/admin/sonata/page/snapshot/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_snapshot_history')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::historyAction',  '_sonata_admin' => 'sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_snapshot_history',));
                                }

                                // admin_sonata_page_snapshot_history_view_revision
                                if (preg_match('#^/admin/sonata/page/snapshot/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_snapshot_history_view_revision')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_snapshot_history_view_revision',));
                                }

                                // admin_sonata_page_snapshot_history_compare_revisions
                                if (preg_match('#^/admin/sonata/page/snapshot/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_snapshot_history_compare_revisions')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_snapshot_history_compare_revisions',));
                                }

                                // admin_sonata_page_snapshot_acl
                                if (preg_match('#^/admin/sonata/page/snapshot/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_snapshot_acl')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SnapshotAdminController::aclAction',  '_sonata_admin' => 'sonata.page.admin.snapshot',  '_sonata_name' => 'admin_sonata_page_snapshot_acl',));
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/sonata/page/site')) {
                                // admin_sonata_page_site_list
                                if ($pathinfo === '/admin/sonata/page/site/list') {
                                    return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SiteAdminController::listAction',  '_sonata_admin' => 'sonata.page.admin.site',  '_sonata_name' => 'admin_sonata_page_site_list',  '_route' => 'admin_sonata_page_site_list',);
                                }

                                // admin_sonata_page_site_create
                                if ($pathinfo === '/admin/sonata/page/site/create') {
                                    return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SiteAdminController::createAction',  '_sonata_admin' => 'sonata.page.admin.site',  '_sonata_name' => 'admin_sonata_page_site_create',  '_route' => 'admin_sonata_page_site_create',);
                                }

                                // admin_sonata_page_site_batch
                                if ($pathinfo === '/admin/sonata/page/site/batch') {
                                    return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SiteAdminController::batchAction',  '_sonata_admin' => 'sonata.page.admin.site',  '_sonata_name' => 'admin_sonata_page_site_batch',  '_route' => 'admin_sonata_page_site_batch',);
                                }

                                // admin_sonata_page_site_edit
                                if (preg_match('#^/admin/sonata/page/site/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_site_edit')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SiteAdminController::editAction',  '_sonata_admin' => 'sonata.page.admin.site',  '_sonata_name' => 'admin_sonata_page_site_edit',));
                                }

                                // admin_sonata_page_site_delete
                                if (preg_match('#^/admin/sonata/page/site/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_site_delete')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SiteAdminController::deleteAction',  '_sonata_admin' => 'sonata.page.admin.site',  '_sonata_name' => 'admin_sonata_page_site_delete',));
                                }

                                // admin_sonata_page_site_show
                                if (preg_match('#^/admin/sonata/page/site/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_site_show')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SiteAdminController::showAction',  '_sonata_admin' => 'sonata.page.admin.site',  '_sonata_name' => 'admin_sonata_page_site_show',));
                                }

                                // admin_sonata_page_site_export
                                if ($pathinfo === '/admin/sonata/page/site/export') {
                                    return array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SiteAdminController::exportAction',  '_sonata_admin' => 'sonata.page.admin.site',  '_sonata_name' => 'admin_sonata_page_site_export',  '_route' => 'admin_sonata_page_site_export',);
                                }

                                // admin_sonata_page_site_history
                                if (preg_match('#^/admin/sonata/page/site/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_site_history')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SiteAdminController::historyAction',  '_sonata_admin' => 'sonata.page.admin.site',  '_sonata_name' => 'admin_sonata_page_site_history',));
                                }

                                // admin_sonata_page_site_history_view_revision
                                if (preg_match('#^/admin/sonata/page/site/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_site_history_view_revision')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SiteAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.page.admin.site',  '_sonata_name' => 'admin_sonata_page_site_history_view_revision',));
                                }

                                // admin_sonata_page_site_history_compare_revisions
                                if (preg_match('#^/admin/sonata/page/site/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_site_history_compare_revisions')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SiteAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.page.admin.site',  '_sonata_name' => 'admin_sonata_page_site_history_compare_revisions',));
                                }

                                // admin_sonata_page_site_acl
                                if (preg_match('#^/admin/sonata/page/site/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_site_acl')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SiteAdminController::aclAction',  '_sonata_admin' => 'sonata.page.admin.site',  '_sonata_name' => 'admin_sonata_page_site_acl',));
                                }

                                // admin_sonata_page_site_snapshots
                                if (preg_match('#^/admin/sonata/page/site/(?P<id>[^/]++)/snapshots$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_page_site_snapshots')), array (  '_controller' => 'Sonata\\PageBundle\\Controller\\SiteAdminController::snapshotsAction',  '_sonata_admin' => 'sonata.page.admin.site',  '_sonata_name' => 'admin_sonata_page_site_snapshots',));
                                }

                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/sonata/news')) {
                        if (0 === strpos($pathinfo, '/admin/sonata/news/post')) {
                            // admin_sonata_news_post_list
                            if ($pathinfo === '/admin/sonata/news/post/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.news.admin.post',  '_sonata_name' => 'admin_sonata_news_post_list',  '_route' => 'admin_sonata_news_post_list',);
                            }

                            // admin_sonata_news_post_create
                            if ($pathinfo === '/admin/sonata/news/post/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.news.admin.post',  '_sonata_name' => 'admin_sonata_news_post_create',  '_route' => 'admin_sonata_news_post_create',);
                            }

                            // admin_sonata_news_post_batch
                            if ($pathinfo === '/admin/sonata/news/post/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.news.admin.post',  '_sonata_name' => 'admin_sonata_news_post_batch',  '_route' => 'admin_sonata_news_post_batch',);
                            }

                            // admin_sonata_news_post_edit
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.news.admin.post',  '_sonata_name' => 'admin_sonata_news_post_edit',));
                            }

                            // admin_sonata_news_post_delete
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.news.admin.post',  '_sonata_name' => 'admin_sonata_news_post_delete',));
                            }

                            // admin_sonata_news_post_show
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.news.admin.post',  '_sonata_name' => 'admin_sonata_news_post_show',));
                            }

                            // admin_sonata_news_post_export
                            if ($pathinfo === '/admin/sonata/news/post/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.news.admin.post',  '_sonata_name' => 'admin_sonata_news_post_export',  '_route' => 'admin_sonata_news_post_export',);
                            }

                            // admin_sonata_news_post_history
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.news.admin.post',  '_sonata_name' => 'admin_sonata_news_post_history',));
                            }

                            // admin_sonata_news_post_history_view_revision
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.news.admin.post',  '_sonata_name' => 'admin_sonata_news_post_history_view_revision',));
                            }

                            // admin_sonata_news_post_history_compare_revisions
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.news.admin.post',  '_sonata_name' => 'admin_sonata_news_post_history_compare_revisions',));
                            }

                            // admin_sonata_news_post_acl
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.news.admin.post',  '_sonata_name' => 'admin_sonata_news_post_acl',));
                            }

                            // admin_sonata_news_post_comment_list
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/comment/list$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_comment_list')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::listAction',  '_sonata_admin' => 'sonata.news.admin.post|sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_post_comment_list',));
                            }

                            // admin_sonata_news_post_comment_create
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/comment/create$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_comment_create')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::createAction',  '_sonata_admin' => 'sonata.news.admin.post|sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_post_comment_create',));
                            }

                            // admin_sonata_news_post_comment_batch
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/comment/batch$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_comment_batch')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::batchAction',  '_sonata_admin' => 'sonata.news.admin.post|sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_post_comment_batch',));
                            }

                            // admin_sonata_news_post_comment_edit
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/comment/(?P<childId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_comment_edit')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::editAction',  '_sonata_admin' => 'sonata.news.admin.post|sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_post_comment_edit',));
                            }

                            // admin_sonata_news_post_comment_delete
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/comment/(?P<childId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_comment_delete')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::deleteAction',  '_sonata_admin' => 'sonata.news.admin.post|sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_post_comment_delete',));
                            }

                            // admin_sonata_news_post_comment_show
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/comment/(?P<childId>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_comment_show')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::showAction',  '_sonata_admin' => 'sonata.news.admin.post|sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_post_comment_show',));
                            }

                            // admin_sonata_news_post_comment_export
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/comment/export$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_comment_export')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::exportAction',  '_sonata_admin' => 'sonata.news.admin.post|sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_post_comment_export',));
                            }

                            // admin_sonata_news_post_comment_history
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/comment/(?P<childId>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_comment_history')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::historyAction',  '_sonata_admin' => 'sonata.news.admin.post|sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_post_comment_history',));
                            }

                            // admin_sonata_news_post_comment_history_view_revision
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/comment/(?P<childId>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_comment_history_view_revision')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.news.admin.post|sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_post_comment_history_view_revision',));
                            }

                            // admin_sonata_news_post_comment_history_compare_revisions
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/comment/(?P<childId>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_comment_history_compare_revisions')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.news.admin.post|sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_post_comment_history_compare_revisions',));
                            }

                            // admin_sonata_news_post_comment_acl
                            if (preg_match('#^/admin/sonata/news/post/(?P<id>[^/]++)/comment/(?P<childId>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_post_comment_acl')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::aclAction',  '_sonata_admin' => 'sonata.news.admin.post|sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_post_comment_acl',));
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/news/comment')) {
                            // admin_sonata_news_comment_list
                            if ($pathinfo === '/admin/sonata/news/comment/list') {
                                return array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::listAction',  '_sonata_admin' => 'sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_comment_list',  '_route' => 'admin_sonata_news_comment_list',);
                            }

                            // admin_sonata_news_comment_create
                            if ($pathinfo === '/admin/sonata/news/comment/create') {
                                return array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::createAction',  '_sonata_admin' => 'sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_comment_create',  '_route' => 'admin_sonata_news_comment_create',);
                            }

                            // admin_sonata_news_comment_batch
                            if ($pathinfo === '/admin/sonata/news/comment/batch') {
                                return array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::batchAction',  '_sonata_admin' => 'sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_comment_batch',  '_route' => 'admin_sonata_news_comment_batch',);
                            }

                            // admin_sonata_news_comment_edit
                            if (preg_match('#^/admin/sonata/news/comment/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_comment_edit')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::editAction',  '_sonata_admin' => 'sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_comment_edit',));
                            }

                            // admin_sonata_news_comment_delete
                            if (preg_match('#^/admin/sonata/news/comment/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_comment_delete')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::deleteAction',  '_sonata_admin' => 'sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_comment_delete',));
                            }

                            // admin_sonata_news_comment_show
                            if (preg_match('#^/admin/sonata/news/comment/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_comment_show')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::showAction',  '_sonata_admin' => 'sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_comment_show',));
                            }

                            // admin_sonata_news_comment_export
                            if ($pathinfo === '/admin/sonata/news/comment/export') {
                                return array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::exportAction',  '_sonata_admin' => 'sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_comment_export',  '_route' => 'admin_sonata_news_comment_export',);
                            }

                            // admin_sonata_news_comment_history
                            if (preg_match('#^/admin/sonata/news/comment/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_comment_history')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::historyAction',  '_sonata_admin' => 'sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_comment_history',));
                            }

                            // admin_sonata_news_comment_history_view_revision
                            if (preg_match('#^/admin/sonata/news/comment/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_comment_history_view_revision')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_comment_history_view_revision',));
                            }

                            // admin_sonata_news_comment_history_compare_revisions
                            if (preg_match('#^/admin/sonata/news/comment/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_comment_history_compare_revisions')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_comment_history_compare_revisions',));
                            }

                            // admin_sonata_news_comment_acl
                            if (preg_match('#^/admin/sonata/news/comment/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_news_comment_acl')), array (  '_controller' => 'Sonata\\NewsBundle\\Controller\\CommentAdminController::aclAction',  '_sonata_admin' => 'sonata.news.admin.comment',  '_sonata_name' => 'admin_sonata_news_comment_acl',));
                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/sonata/media')) {
                        if (0 === strpos($pathinfo, '/admin/sonata/media/media')) {
                            // admin_sonata_media_media_list
                            if ($pathinfo === '/admin/sonata/media/media/list') {
                                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::listAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_list',  '_route' => 'admin_sonata_media_media_list',);
                            }

                            // admin_sonata_media_media_create
                            if ($pathinfo === '/admin/sonata/media/media/create') {
                                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::createAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_create',  '_route' => 'admin_sonata_media_media_create',);
                            }

                            // admin_sonata_media_media_batch
                            if ($pathinfo === '/admin/sonata/media/media/batch') {
                                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::batchAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_batch',  '_route' => 'admin_sonata_media_media_batch',);
                            }

                            // admin_sonata_media_media_edit
                            if (preg_match('#^/admin/sonata/media/media/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_media_edit')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::editAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_edit',));
                            }

                            // admin_sonata_media_media_delete
                            if (preg_match('#^/admin/sonata/media/media/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_media_delete')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_delete',));
                            }

                            // admin_sonata_media_media_show
                            if (preg_match('#^/admin/sonata/media/media/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_media_show')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::showAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_show',));
                            }

                            // admin_sonata_media_media_export
                            if ($pathinfo === '/admin/sonata/media/media/export') {
                                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::exportAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_export',  '_route' => 'admin_sonata_media_media_export',);
                            }

                            // admin_sonata_media_media_history
                            if (preg_match('#^/admin/sonata/media/media/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_media_history')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::historyAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_history',));
                            }

                            // admin_sonata_media_media_history_view_revision
                            if (preg_match('#^/admin/sonata/media/media/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_media_history_view_revision')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_history_view_revision',));
                            }

                            // admin_sonata_media_media_history_compare_revisions
                            if (preg_match('#^/admin/sonata/media/media/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_media_history_compare_revisions')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_history_compare_revisions',));
                            }

                            // admin_sonata_media_media_acl
                            if (preg_match('#^/admin/sonata/media/media/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_media_acl')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::aclAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_acl',));
                            }

                            if (0 === strpos($pathinfo, '/admin/sonata/media/media/ckeditor_')) {
                                // admin_sonata_media_media_ckeditor_browser
                                if ($pathinfo === '/admin/sonata/media/media/ckeditor_browser') {
                                    return array (  '_controller' => 'Sonata\\FormatterBundle\\Controller\\CkeditorAdminController::browserAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_ckeditor_browser',  '_route' => 'admin_sonata_media_media_ckeditor_browser',);
                                }

                                // admin_sonata_media_media_ckeditor_upload
                                if ($pathinfo === '/admin/sonata/media/media/ckeditor_upload') {
                                    return array (  '_controller' => 'Sonata\\FormatterBundle\\Controller\\CkeditorAdminController::uploadAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_ckeditor_upload',  '_route' => 'admin_sonata_media_media_ckeditor_upload',);
                                }

                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/media/gallery')) {
                            // admin_sonata_media_gallery_list
                            if ($pathinfo === '/admin/sonata/media/gallery/list') {
                                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::listAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_list',  '_route' => 'admin_sonata_media_gallery_list',);
                            }

                            // admin_sonata_media_gallery_create
                            if ($pathinfo === '/admin/sonata/media/gallery/create') {
                                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::createAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_create',  '_route' => 'admin_sonata_media_gallery_create',);
                            }

                            // admin_sonata_media_gallery_batch
                            if ($pathinfo === '/admin/sonata/media/gallery/batch') {
                                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::batchAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_batch',  '_route' => 'admin_sonata_media_gallery_batch',);
                            }

                            // admin_sonata_media_gallery_edit
                            if (preg_match('#^/admin/sonata/media/gallery/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_gallery_edit')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::editAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_edit',));
                            }

                            // admin_sonata_media_gallery_delete
                            if (preg_match('#^/admin/sonata/media/gallery/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_gallery_delete')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_delete',));
                            }

                            // admin_sonata_media_gallery_show
                            if (preg_match('#^/admin/sonata/media/gallery/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_gallery_show')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::showAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_show',));
                            }

                            // admin_sonata_media_gallery_export
                            if ($pathinfo === '/admin/sonata/media/gallery/export') {
                                return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::exportAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_export',  '_route' => 'admin_sonata_media_gallery_export',);
                            }

                            // admin_sonata_media_gallery_history
                            if (preg_match('#^/admin/sonata/media/gallery/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_gallery_history')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::historyAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_history',));
                            }

                            // admin_sonata_media_gallery_history_view_revision
                            if (preg_match('#^/admin/sonata/media/gallery/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_gallery_history_view_revision')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_history_view_revision',));
                            }

                            // admin_sonata_media_gallery_history_compare_revisions
                            if (preg_match('#^/admin/sonata/media/gallery/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_gallery_history_compare_revisions')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_history_compare_revisions',));
                            }

                            // admin_sonata_media_gallery_acl
                            if (preg_match('#^/admin/sonata/media/gallery/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_gallery_acl')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::aclAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_acl',));
                            }

                            if (0 === strpos($pathinfo, '/admin/sonata/media/galleryhasmedia')) {
                                // admin_sonata_media_galleryhasmedia_list
                                if ($pathinfo === '/admin/sonata/media/galleryhasmedia/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_list',  '_route' => 'admin_sonata_media_galleryhasmedia_list',);
                                }

                                // admin_sonata_media_galleryhasmedia_create
                                if ($pathinfo === '/admin/sonata/media/galleryhasmedia/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_create',  '_route' => 'admin_sonata_media_galleryhasmedia_create',);
                                }

                                // admin_sonata_media_galleryhasmedia_batch
                                if ($pathinfo === '/admin/sonata/media/galleryhasmedia/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_batch',  '_route' => 'admin_sonata_media_galleryhasmedia_batch',);
                                }

                                // admin_sonata_media_galleryhasmedia_edit
                                if (preg_match('#^/admin/sonata/media/galleryhasmedia/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_galleryhasmedia_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_edit',));
                                }

                                // admin_sonata_media_galleryhasmedia_delete
                                if (preg_match('#^/admin/sonata/media/galleryhasmedia/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_galleryhasmedia_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_delete',));
                                }

                                // admin_sonata_media_galleryhasmedia_show
                                if (preg_match('#^/admin/sonata/media/galleryhasmedia/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_galleryhasmedia_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_show',));
                                }

                                // admin_sonata_media_galleryhasmedia_export
                                if ($pathinfo === '/admin/sonata/media/galleryhasmedia/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_export',  '_route' => 'admin_sonata_media_galleryhasmedia_export',);
                                }

                                // admin_sonata_media_galleryhasmedia_history
                                if (preg_match('#^/admin/sonata/media/galleryhasmedia/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_galleryhasmedia_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_history',));
                                }

                                // admin_sonata_media_galleryhasmedia_history_view_revision
                                if (preg_match('#^/admin/sonata/media/galleryhasmedia/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_galleryhasmedia_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_history_view_revision',));
                                }

                                // admin_sonata_media_galleryhasmedia_history_compare_revisions
                                if (preg_match('#^/admin/sonata/media/galleryhasmedia/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_galleryhasmedia_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_history_compare_revisions',));
                                }

                                // admin_sonata_media_galleryhasmedia_acl
                                if (preg_match('#^/admin/sonata/media/galleryhasmedia/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_galleryhasmedia_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_acl',));
                                }

                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/sonata/customer')) {
                        if (0 === strpos($pathinfo, '/admin/sonata/customer/customer')) {
                            // admin_sonata_customer_customer_list
                            if ($pathinfo === '/admin/sonata/customer/customer/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.customer.admin.customer',  '_sonata_name' => 'admin_sonata_customer_customer_list',  '_route' => 'admin_sonata_customer_customer_list',);
                            }

                            // admin_sonata_customer_customer_create
                            if ($pathinfo === '/admin/sonata/customer/customer/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.customer.admin.customer',  '_sonata_name' => 'admin_sonata_customer_customer_create',  '_route' => 'admin_sonata_customer_customer_create',);
                            }

                            // admin_sonata_customer_customer_batch
                            if ($pathinfo === '/admin/sonata/customer/customer/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.customer.admin.customer',  '_sonata_name' => 'admin_sonata_customer_customer_batch',  '_route' => 'admin_sonata_customer_customer_batch',);
                            }

                            // admin_sonata_customer_customer_edit
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.customer.admin.customer',  '_sonata_name' => 'admin_sonata_customer_customer_edit',));
                            }

                            // admin_sonata_customer_customer_delete
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.customer.admin.customer',  '_sonata_name' => 'admin_sonata_customer_customer_delete',));
                            }

                            // admin_sonata_customer_customer_show
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.customer.admin.customer',  '_sonata_name' => 'admin_sonata_customer_customer_show',));
                            }

                            // admin_sonata_customer_customer_export
                            if ($pathinfo === '/admin/sonata/customer/customer/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.customer.admin.customer',  '_sonata_name' => 'admin_sonata_customer_customer_export',  '_route' => 'admin_sonata_customer_customer_export',);
                            }

                            // admin_sonata_customer_customer_history
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.customer.admin.customer',  '_sonata_name' => 'admin_sonata_customer_customer_history',));
                            }

                            // admin_sonata_customer_customer_history_view_revision
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.customer.admin.customer',  '_sonata_name' => 'admin_sonata_customer_customer_history_view_revision',));
                            }

                            // admin_sonata_customer_customer_history_compare_revisions
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.customer.admin.customer',  '_sonata_name' => 'admin_sonata_customer_customer_history_compare_revisions',));
                            }

                            // admin_sonata_customer_customer_acl
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.customer.admin.customer',  '_sonata_name' => 'admin_sonata_customer_customer_acl',));
                            }

                            // admin_sonata_customer_customer_address_list
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/address/list$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_address_list')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_customer_address_list',));
                            }

                            // admin_sonata_customer_customer_address_create
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/address/create$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_address_create')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_customer_address_create',));
                            }

                            // admin_sonata_customer_customer_address_batch
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/address/batch$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_address_batch')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_customer_address_batch',));
                            }

                            // admin_sonata_customer_customer_address_edit
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/address/(?P<childId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_address_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_customer_address_edit',));
                            }

                            // admin_sonata_customer_customer_address_delete
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/address/(?P<childId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_address_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_customer_address_delete',));
                            }

                            // admin_sonata_customer_customer_address_show
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/address/(?P<childId>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_address_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_customer_address_show',));
                            }

                            // admin_sonata_customer_customer_address_export
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/address/export$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_address_export')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_customer_address_export',));
                            }

                            // admin_sonata_customer_customer_address_history
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/address/(?P<childId>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_address_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_customer_address_history',));
                            }

                            // admin_sonata_customer_customer_address_history_view_revision
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/address/(?P<childId>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_address_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_customer_address_history_view_revision',));
                            }

                            // admin_sonata_customer_customer_address_history_compare_revisions
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/address/(?P<childId>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_address_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_customer_address_history_compare_revisions',));
                            }

                            // admin_sonata_customer_customer_address_acl
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/address/(?P<childId>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_address_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_customer_address_acl',));
                            }

                            // admin_sonata_customer_customer_order_list
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/order/list$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_order_list')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::listAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_customer_customer_order_list',));
                            }

                            // admin_sonata_customer_customer_order_batch
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/order/batch$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_order_batch')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::batchAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_customer_customer_order_batch',));
                            }

                            // admin_sonata_customer_customer_order_edit
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/order/(?P<childId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_order_edit')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::editAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_customer_customer_order_edit',));
                            }

                            // admin_sonata_customer_customer_order_delete
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/order/(?P<childId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_order_delete')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::deleteAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_customer_customer_order_delete',));
                            }

                            // admin_sonata_customer_customer_order_show
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/order/(?P<childId>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_order_show')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::showAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_customer_customer_order_show',));
                            }

                            // admin_sonata_customer_customer_order_export
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/order/export$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_order_export')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::exportAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_customer_customer_order_export',));
                            }

                            // admin_sonata_customer_customer_order_history
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/order/(?P<childId>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_order_history')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::historyAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_customer_customer_order_history',));
                            }

                            // admin_sonata_customer_customer_order_history_view_revision
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/order/(?P<childId>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_order_history_view_revision')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_customer_customer_order_history_view_revision',));
                            }

                            // admin_sonata_customer_customer_order_history_compare_revisions
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/order/(?P<childId>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_order_history_compare_revisions')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_customer_customer_order_history_compare_revisions',));
                            }

                            // admin_sonata_customer_customer_order_acl
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/order/(?P<childId>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_order_acl')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::aclAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_customer_customer_order_acl',));
                            }

                            // admin_sonata_customer_customer_order_generateInvoice
                            if (preg_match('#^/admin/sonata/customer/customer/(?P<id>[^/]++)/order/generateInvoice$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_customer_order_generateInvoice')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::generateInvoiceAction',  '_sonata_admin' => 'sonata.customer.admin.customer|sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_customer_customer_order_generateInvoice',));
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/customer/address')) {
                            // admin_sonata_customer_address_list
                            if ($pathinfo === '/admin/sonata/customer/address/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_address_list',  '_route' => 'admin_sonata_customer_address_list',);
                            }

                            // admin_sonata_customer_address_create
                            if ($pathinfo === '/admin/sonata/customer/address/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_address_create',  '_route' => 'admin_sonata_customer_address_create',);
                            }

                            // admin_sonata_customer_address_batch
                            if ($pathinfo === '/admin/sonata/customer/address/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_address_batch',  '_route' => 'admin_sonata_customer_address_batch',);
                            }

                            // admin_sonata_customer_address_edit
                            if (preg_match('#^/admin/sonata/customer/address/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_address_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_address_edit',));
                            }

                            // admin_sonata_customer_address_delete
                            if (preg_match('#^/admin/sonata/customer/address/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_address_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_address_delete',));
                            }

                            // admin_sonata_customer_address_show
                            if (preg_match('#^/admin/sonata/customer/address/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_address_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_address_show',));
                            }

                            // admin_sonata_customer_address_export
                            if ($pathinfo === '/admin/sonata/customer/address/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_address_export',  '_route' => 'admin_sonata_customer_address_export',);
                            }

                            // admin_sonata_customer_address_history
                            if (preg_match('#^/admin/sonata/customer/address/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_address_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_address_history',));
                            }

                            // admin_sonata_customer_address_history_view_revision
                            if (preg_match('#^/admin/sonata/customer/address/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_address_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_address_history_view_revision',));
                            }

                            // admin_sonata_customer_address_history_compare_revisions
                            if (preg_match('#^/admin/sonata/customer/address/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_address_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_address_history_compare_revisions',));
                            }

                            // admin_sonata_customer_address_acl
                            if (preg_match('#^/admin/sonata/customer/address/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_customer_address_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.customer.admin.address',  '_sonata_name' => 'admin_sonata_customer_address_acl',));
                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/sonata/invoice/invoice')) {
                        // admin_sonata_invoice_invoice_list
                        if ($pathinfo === '/admin/sonata/invoice/invoice/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.invoice.admin.invoice',  '_sonata_name' => 'admin_sonata_invoice_invoice_list',  '_route' => 'admin_sonata_invoice_invoice_list',);
                        }

                        // admin_sonata_invoice_invoice_create
                        if ($pathinfo === '/admin/sonata/invoice/invoice/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.invoice.admin.invoice',  '_sonata_name' => 'admin_sonata_invoice_invoice_create',  '_route' => 'admin_sonata_invoice_invoice_create',);
                        }

                        // admin_sonata_invoice_invoice_batch
                        if ($pathinfo === '/admin/sonata/invoice/invoice/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.invoice.admin.invoice',  '_sonata_name' => 'admin_sonata_invoice_invoice_batch',  '_route' => 'admin_sonata_invoice_invoice_batch',);
                        }

                        // admin_sonata_invoice_invoice_edit
                        if (preg_match('#^/admin/sonata/invoice/invoice/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_invoice_invoice_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.invoice.admin.invoice',  '_sonata_name' => 'admin_sonata_invoice_invoice_edit',));
                        }

                        // admin_sonata_invoice_invoice_delete
                        if (preg_match('#^/admin/sonata/invoice/invoice/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_invoice_invoice_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.invoice.admin.invoice',  '_sonata_name' => 'admin_sonata_invoice_invoice_delete',));
                        }

                        // admin_sonata_invoice_invoice_show
                        if (preg_match('#^/admin/sonata/invoice/invoice/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_invoice_invoice_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.invoice.admin.invoice',  '_sonata_name' => 'admin_sonata_invoice_invoice_show',));
                        }

                        // admin_sonata_invoice_invoice_export
                        if ($pathinfo === '/admin/sonata/invoice/invoice/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.invoice.admin.invoice',  '_sonata_name' => 'admin_sonata_invoice_invoice_export',  '_route' => 'admin_sonata_invoice_invoice_export',);
                        }

                        // admin_sonata_invoice_invoice_history
                        if (preg_match('#^/admin/sonata/invoice/invoice/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_invoice_invoice_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.invoice.admin.invoice',  '_sonata_name' => 'admin_sonata_invoice_invoice_history',));
                        }

                        // admin_sonata_invoice_invoice_history_view_revision
                        if (preg_match('#^/admin/sonata/invoice/invoice/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_invoice_invoice_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.invoice.admin.invoice',  '_sonata_name' => 'admin_sonata_invoice_invoice_history_view_revision',));
                        }

                        // admin_sonata_invoice_invoice_history_compare_revisions
                        if (preg_match('#^/admin/sonata/invoice/invoice/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_invoice_invoice_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.invoice.admin.invoice',  '_sonata_name' => 'admin_sonata_invoice_invoice_history_compare_revisions',));
                        }

                        // admin_sonata_invoice_invoice_acl
                        if (preg_match('#^/admin/sonata/invoice/invoice/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_invoice_invoice_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.invoice.admin.invoice',  '_sonata_name' => 'admin_sonata_invoice_invoice_acl',));
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/sonata/order/order')) {
                        // admin_sonata_order_order_list
                        if ($pathinfo === '/admin/sonata/order/order/list') {
                            return array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::listAction',  '_sonata_admin' => 'sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_order_order_list',  '_route' => 'admin_sonata_order_order_list',);
                        }

                        // admin_sonata_order_order_batch
                        if ($pathinfo === '/admin/sonata/order/order/batch') {
                            return array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::batchAction',  '_sonata_admin' => 'sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_order_order_batch',  '_route' => 'admin_sonata_order_order_batch',);
                        }

                        // admin_sonata_order_order_edit
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_edit')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::editAction',  '_sonata_admin' => 'sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_order_order_edit',));
                        }

                        // admin_sonata_order_order_delete
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_delete')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::deleteAction',  '_sonata_admin' => 'sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_order_order_delete',));
                        }

                        // admin_sonata_order_order_show
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_show')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::showAction',  '_sonata_admin' => 'sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_order_order_show',));
                        }

                        // admin_sonata_order_order_export
                        if ($pathinfo === '/admin/sonata/order/order/export') {
                            return array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::exportAction',  '_sonata_admin' => 'sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_order_order_export',  '_route' => 'admin_sonata_order_order_export',);
                        }

                        // admin_sonata_order_order_history
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_history')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::historyAction',  '_sonata_admin' => 'sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_order_order_history',));
                        }

                        // admin_sonata_order_order_history_view_revision
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_history_view_revision')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_order_order_history_view_revision',));
                        }

                        // admin_sonata_order_order_history_compare_revisions
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_history_compare_revisions')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_order_order_history_compare_revisions',));
                        }

                        // admin_sonata_order_order_acl
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_acl')), array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::aclAction',  '_sonata_admin' => 'sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_order_order_acl',));
                        }

                        // admin_sonata_order_order_orderelement_list
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/orderelement/list$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_orderelement_list')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.order.admin.order|sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_order_orderelement_list',));
                        }

                        // admin_sonata_order_order_orderelement_create
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/orderelement/create$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_orderelement_create')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.order.admin.order|sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_order_orderelement_create',));
                        }

                        // admin_sonata_order_order_orderelement_batch
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/orderelement/batch$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_orderelement_batch')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.order.admin.order|sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_order_orderelement_batch',));
                        }

                        // admin_sonata_order_order_orderelement_edit
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/orderelement/(?P<childId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_orderelement_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.order.admin.order|sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_order_orderelement_edit',));
                        }

                        // admin_sonata_order_order_orderelement_delete
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/orderelement/(?P<childId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_orderelement_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.order.admin.order|sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_order_orderelement_delete',));
                        }

                        // admin_sonata_order_order_orderelement_show
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/orderelement/(?P<childId>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_orderelement_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.order.admin.order|sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_order_orderelement_show',));
                        }

                        // admin_sonata_order_order_orderelement_export
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/orderelement/export$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_orderelement_export')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.order.admin.order|sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_order_orderelement_export',));
                        }

                        // admin_sonata_order_order_orderelement_history
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/orderelement/(?P<childId>[^/]++)/history$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_orderelement_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.order.admin.order|sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_order_orderelement_history',));
                        }

                        // admin_sonata_order_order_orderelement_history_view_revision
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/orderelement/(?P<childId>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_orderelement_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.order.admin.order|sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_order_orderelement_history_view_revision',));
                        }

                        // admin_sonata_order_order_orderelement_history_compare_revisions
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/orderelement/(?P<childId>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_orderelement_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.order.admin.order|sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_order_orderelement_history_compare_revisions',));
                        }

                        // admin_sonata_order_order_orderelement_acl
                        if (preg_match('#^/admin/sonata/order/order/(?P<id>[^/]++)/orderelement/(?P<childId>[^/]++)/acl$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_order_orderelement_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.order.admin.order|sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_order_orderelement_acl',));
                        }

                        // admin_sonata_order_order_generateInvoice
                        if ($pathinfo === '/admin/sonata/order/order/generateInvoice') {
                            return array (  '_controller' => 'Sonata\\OrderBundle\\Controller\\OrderCRUDController::generateInvoiceAction',  '_sonata_admin' => 'sonata.order.admin.order',  '_sonata_name' => 'admin_sonata_order_order_generateInvoice',  '_route' => 'admin_sonata_order_order_generateInvoice',);
                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/order/orderelement')) {
                            // admin_sonata_order_orderelement_list
                            if ($pathinfo === '/admin/sonata/order/orderelement/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_orderelement_list',  '_route' => 'admin_sonata_order_orderelement_list',);
                            }

                            // admin_sonata_order_orderelement_create
                            if ($pathinfo === '/admin/sonata/order/orderelement/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_orderelement_create',  '_route' => 'admin_sonata_order_orderelement_create',);
                            }

                            // admin_sonata_order_orderelement_batch
                            if ($pathinfo === '/admin/sonata/order/orderelement/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_orderelement_batch',  '_route' => 'admin_sonata_order_orderelement_batch',);
                            }

                            // admin_sonata_order_orderelement_edit
                            if (preg_match('#^/admin/sonata/order/orderelement/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_orderelement_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_orderelement_edit',));
                            }

                            // admin_sonata_order_orderelement_delete
                            if (preg_match('#^/admin/sonata/order/orderelement/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_orderelement_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_orderelement_delete',));
                            }

                            // admin_sonata_order_orderelement_show
                            if (preg_match('#^/admin/sonata/order/orderelement/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_orderelement_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_orderelement_show',));
                            }

                            // admin_sonata_order_orderelement_export
                            if ($pathinfo === '/admin/sonata/order/orderelement/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_orderelement_export',  '_route' => 'admin_sonata_order_orderelement_export',);
                            }

                            // admin_sonata_order_orderelement_history
                            if (preg_match('#^/admin/sonata/order/orderelement/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_orderelement_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_orderelement_history',));
                            }

                            // admin_sonata_order_orderelement_history_view_revision
                            if (preg_match('#^/admin/sonata/order/orderelement/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_orderelement_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_orderelement_history_view_revision',));
                            }

                            // admin_sonata_order_orderelement_history_compare_revisions
                            if (preg_match('#^/admin/sonata/order/orderelement/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_orderelement_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_orderelement_history_compare_revisions',));
                            }

                            // admin_sonata_order_orderelement_acl
                            if (preg_match('#^/admin/sonata/order/orderelement/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_order_orderelement_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.order.admin.order_element',  '_sonata_name' => 'admin_sonata_order_orderelement_acl',));
                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/sonata/product')) {
                        if (0 === strpos($pathinfo, '/admin/sonata/product/product')) {
                            // admin_sonata_product_product_list
                            if ($pathinfo === '/admin/sonata/product/product/list') {
                                return array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductAdminController::listAction',  '_sonata_admin' => 'sonata.product.admin.product',  '_sonata_name' => 'admin_sonata_product_product_list',  '_route' => 'admin_sonata_product_product_list',);
                            }

                            // admin_sonata_product_product_create
                            if ($pathinfo === '/admin/sonata/product/product/create') {
                                return array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductAdminController::createAction',  '_sonata_admin' => 'sonata.product.admin.product',  '_sonata_name' => 'admin_sonata_product_product_create',  '_route' => 'admin_sonata_product_product_create',);
                            }

                            // admin_sonata_product_product_batch
                            if ($pathinfo === '/admin/sonata/product/product/batch') {
                                return array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductAdminController::batchAction',  '_sonata_admin' => 'sonata.product.admin.product',  '_sonata_name' => 'admin_sonata_product_product_batch',  '_route' => 'admin_sonata_product_product_batch',);
                            }

                            // admin_sonata_product_product_edit
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_edit')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductAdminController::editAction',  '_sonata_admin' => 'sonata.product.admin.product',  '_sonata_name' => 'admin_sonata_product_product_edit',));
                            }

                            // admin_sonata_product_product_delete
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_delete')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductAdminController::deleteAction',  '_sonata_admin' => 'sonata.product.admin.product',  '_sonata_name' => 'admin_sonata_product_product_delete',));
                            }

                            // admin_sonata_product_product_show
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_show')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductAdminController::showAction',  '_sonata_admin' => 'sonata.product.admin.product',  '_sonata_name' => 'admin_sonata_product_product_show',));
                            }

                            // admin_sonata_product_product_export
                            if ($pathinfo === '/admin/sonata/product/product/export') {
                                return array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductAdminController::exportAction',  '_sonata_admin' => 'sonata.product.admin.product',  '_sonata_name' => 'admin_sonata_product_product_export',  '_route' => 'admin_sonata_product_product_export',);
                            }

                            // admin_sonata_product_product_history
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_history')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductAdminController::historyAction',  '_sonata_admin' => 'sonata.product.admin.product',  '_sonata_name' => 'admin_sonata_product_product_history',));
                            }

                            // admin_sonata_product_product_history_view_revision
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_history_view_revision')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.product.admin.product',  '_sonata_name' => 'admin_sonata_product_product_history_view_revision',));
                            }

                            // admin_sonata_product_product_history_compare_revisions
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_history_compare_revisions')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.product.admin.product',  '_sonata_name' => 'admin_sonata_product_product_history_compare_revisions',));
                            }

                            // admin_sonata_product_product_acl
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_acl')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductAdminController::aclAction',  '_sonata_admin' => 'sonata.product.admin.product',  '_sonata_name' => 'admin_sonata_product_product_acl',));
                            }

                            // admin_sonata_product_product_productcategory_list
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcategory/list$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcategory_list')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_product_productcategory_list',));
                            }

                            // admin_sonata_product_product_productcategory_create
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcategory/create$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcategory_create')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_product_productcategory_create',));
                            }

                            // admin_sonata_product_product_productcategory_batch
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcategory/batch$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcategory_batch')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_product_productcategory_batch',));
                            }

                            // admin_sonata_product_product_productcategory_edit
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcategory/(?P<childId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcategory_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_product_productcategory_edit',));
                            }

                            // admin_sonata_product_product_productcategory_delete
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcategory/(?P<childId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcategory_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_product_productcategory_delete',));
                            }

                            // admin_sonata_product_product_productcategory_show
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcategory/(?P<childId>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcategory_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_product_productcategory_show',));
                            }

                            // admin_sonata_product_product_productcategory_export
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcategory/export$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcategory_export')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_product_productcategory_export',));
                            }

                            // admin_sonata_product_product_productcategory_history
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcategory/(?P<childId>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcategory_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_product_productcategory_history',));
                            }

                            // admin_sonata_product_product_productcategory_history_view_revision
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcategory/(?P<childId>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcategory_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_product_productcategory_history_view_revision',));
                            }

                            // admin_sonata_product_product_productcategory_history_compare_revisions
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcategory/(?P<childId>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcategory_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_product_productcategory_history_compare_revisions',));
                            }

                            // admin_sonata_product_product_productcategory_acl
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcategory/(?P<childId>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcategory_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_product_productcategory_acl',));
                            }

                            // admin_sonata_product_product_productcollection_list
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcollection/list$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcollection_list')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_product_productcollection_list',));
                            }

                            // admin_sonata_product_product_productcollection_create
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcollection/create$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcollection_create')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_product_productcollection_create',));
                            }

                            // admin_sonata_product_product_productcollection_batch
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcollection/batch$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcollection_batch')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_product_productcollection_batch',));
                            }

                            // admin_sonata_product_product_productcollection_edit
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcollection/(?P<childId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcollection_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_product_productcollection_edit',));
                            }

                            // admin_sonata_product_product_productcollection_delete
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcollection/(?P<childId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcollection_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_product_productcollection_delete',));
                            }

                            // admin_sonata_product_product_productcollection_show
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcollection/(?P<childId>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcollection_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_product_productcollection_show',));
                            }

                            // admin_sonata_product_product_productcollection_export
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcollection/export$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcollection_export')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_product_productcollection_export',));
                            }

                            // admin_sonata_product_product_productcollection_history
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcollection/(?P<childId>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcollection_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_product_productcollection_history',));
                            }

                            // admin_sonata_product_product_productcollection_history_view_revision
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcollection/(?P<childId>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcollection_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_product_productcollection_history_view_revision',));
                            }

                            // admin_sonata_product_product_productcollection_history_compare_revisions
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcollection/(?P<childId>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcollection_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_product_productcollection_history_compare_revisions',));
                            }

                            // admin_sonata_product_product_productcollection_acl
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/productcollection/(?P<childId>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_productcollection_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_product_productcollection_acl',));
                            }

                            // admin_sonata_product_product_delivery_list
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/delivery/list$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_delivery_list')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_product_delivery_list',));
                            }

                            // admin_sonata_product_product_delivery_create
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/delivery/create$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_delivery_create')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_product_delivery_create',));
                            }

                            // admin_sonata_product_product_delivery_batch
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/delivery/batch$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_delivery_batch')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_product_delivery_batch',));
                            }

                            // admin_sonata_product_product_delivery_edit
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/delivery/(?P<childId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_delivery_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_product_delivery_edit',));
                            }

                            // admin_sonata_product_product_delivery_delete
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/delivery/(?P<childId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_delivery_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_product_delivery_delete',));
                            }

                            // admin_sonata_product_product_delivery_show
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/delivery/(?P<childId>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_delivery_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_product_delivery_show',));
                            }

                            // admin_sonata_product_product_delivery_export
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/delivery/export$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_delivery_export')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_product_delivery_export',));
                            }

                            // admin_sonata_product_product_delivery_history
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/delivery/(?P<childId>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_delivery_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_product_delivery_history',));
                            }

                            // admin_sonata_product_product_delivery_history_view_revision
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/delivery/(?P<childId>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_delivery_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_product_delivery_history_view_revision',));
                            }

                            // admin_sonata_product_product_delivery_history_compare_revisions
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/delivery/(?P<childId>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_delivery_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_product_delivery_history_compare_revisions',));
                            }

                            // admin_sonata_product_product_delivery_acl
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/delivery/(?P<childId>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_delivery_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_product_delivery_acl',));
                            }

                            // admin_sonata_product_product_variation_list
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/variation/list$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_variation_list')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::listAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_product_variation_list',));
                            }

                            // admin_sonata_product_product_variation_create
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/variation/create$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_variation_create')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::createAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_product_variation_create',));
                            }

                            // admin_sonata_product_product_variation_batch
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/variation/batch$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_variation_batch')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::batchAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_product_variation_batch',));
                            }

                            // admin_sonata_product_product_variation_edit
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/variation/(?P<childId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_variation_edit')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::editAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_product_variation_edit',));
                            }

                            // admin_sonata_product_product_variation_delete
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/variation/(?P<childId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_variation_delete')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::deleteAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_product_variation_delete',));
                            }

                            // admin_sonata_product_product_variation_show
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/variation/(?P<childId>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_variation_show')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::showAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_product_variation_show',));
                            }

                            // admin_sonata_product_product_variation_export
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/variation/export$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_variation_export')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::exportAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_product_variation_export',));
                            }

                            // admin_sonata_product_product_variation_history
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/variation/(?P<childId>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_variation_history')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::historyAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_product_variation_history',));
                            }

                            // admin_sonata_product_product_variation_history_view_revision
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/variation/(?P<childId>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_variation_history_view_revision')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_product_variation_history_view_revision',));
                            }

                            // admin_sonata_product_product_variation_history_compare_revisions
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/variation/(?P<childId>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_variation_history_compare_revisions')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_product_variation_history_compare_revisions',));
                            }

                            // admin_sonata_product_product_variation_acl
                            if (preg_match('#^/admin/sonata/product/product/(?P<id>[^/]++)/variation/(?P<childId>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_product_variation_acl')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::aclAction',  '_sonata_admin' => 'sonata.product.admin.product|sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_product_variation_acl',));
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/product/variation')) {
                            // admin_sonata_product_variation_list
                            if ($pathinfo === '/admin/sonata/product/variation/list') {
                                return array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::listAction',  '_sonata_admin' => 'sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_variation_list',  '_route' => 'admin_sonata_product_variation_list',);
                            }

                            // admin_sonata_product_variation_create
                            if ($pathinfo === '/admin/sonata/product/variation/create') {
                                return array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::createAction',  '_sonata_admin' => 'sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_variation_create',  '_route' => 'admin_sonata_product_variation_create',);
                            }

                            // admin_sonata_product_variation_batch
                            if ($pathinfo === '/admin/sonata/product/variation/batch') {
                                return array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::batchAction',  '_sonata_admin' => 'sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_variation_batch',  '_route' => 'admin_sonata_product_variation_batch',);
                            }

                            // admin_sonata_product_variation_edit
                            if (preg_match('#^/admin/sonata/product/variation/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_variation_edit')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::editAction',  '_sonata_admin' => 'sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_variation_edit',));
                            }

                            // admin_sonata_product_variation_delete
                            if (preg_match('#^/admin/sonata/product/variation/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_variation_delete')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::deleteAction',  '_sonata_admin' => 'sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_variation_delete',));
                            }

                            // admin_sonata_product_variation_show
                            if (preg_match('#^/admin/sonata/product/variation/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_variation_show')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::showAction',  '_sonata_admin' => 'sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_variation_show',));
                            }

                            // admin_sonata_product_variation_export
                            if ($pathinfo === '/admin/sonata/product/variation/export') {
                                return array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::exportAction',  '_sonata_admin' => 'sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_variation_export',  '_route' => 'admin_sonata_product_variation_export',);
                            }

                            // admin_sonata_product_variation_history
                            if (preg_match('#^/admin/sonata/product/variation/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_variation_history')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::historyAction',  '_sonata_admin' => 'sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_variation_history',));
                            }

                            // admin_sonata_product_variation_history_view_revision
                            if (preg_match('#^/admin/sonata/product/variation/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_variation_history_view_revision')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_variation_history_view_revision',));
                            }

                            // admin_sonata_product_variation_history_compare_revisions
                            if (preg_match('#^/admin/sonata/product/variation/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_variation_history_compare_revisions')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_variation_history_compare_revisions',));
                            }

                            // admin_sonata_product_variation_acl
                            if (preg_match('#^/admin/sonata/product/variation/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_variation_acl')), array (  '_controller' => 'Sonata\\ProductBundle\\Controller\\ProductVariationAdminController::aclAction',  '_sonata_admin' => 'sonata.product.admin.product.variation',  '_sonata_name' => 'admin_sonata_product_variation_acl',));
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/product/productc')) {
                            if (0 === strpos($pathinfo, '/admin/sonata/product/productcategory')) {
                                // admin_sonata_product_productcategory_list
                                if ($pathinfo === '/admin/sonata/product/productcategory/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_productcategory_list',  '_route' => 'admin_sonata_product_productcategory_list',);
                                }

                                // admin_sonata_product_productcategory_create
                                if ($pathinfo === '/admin/sonata/product/productcategory/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_productcategory_create',  '_route' => 'admin_sonata_product_productcategory_create',);
                                }

                                // admin_sonata_product_productcategory_batch
                                if ($pathinfo === '/admin/sonata/product/productcategory/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_productcategory_batch',  '_route' => 'admin_sonata_product_productcategory_batch',);
                                }

                                // admin_sonata_product_productcategory_edit
                                if (preg_match('#^/admin/sonata/product/productcategory/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_productcategory_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_productcategory_edit',));
                                }

                                // admin_sonata_product_productcategory_delete
                                if (preg_match('#^/admin/sonata/product/productcategory/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_productcategory_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_productcategory_delete',));
                                }

                                // admin_sonata_product_productcategory_show
                                if (preg_match('#^/admin/sonata/product/productcategory/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_productcategory_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_productcategory_show',));
                                }

                                // admin_sonata_product_productcategory_export
                                if ($pathinfo === '/admin/sonata/product/productcategory/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_productcategory_export',  '_route' => 'admin_sonata_product_productcategory_export',);
                                }

                                // admin_sonata_product_productcategory_history
                                if (preg_match('#^/admin/sonata/product/productcategory/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_productcategory_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_productcategory_history',));
                                }

                                // admin_sonata_product_productcategory_history_view_revision
                                if (preg_match('#^/admin/sonata/product/productcategory/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_productcategory_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_productcategory_history_view_revision',));
                                }

                                // admin_sonata_product_productcategory_history_compare_revisions
                                if (preg_match('#^/admin/sonata/product/productcategory/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_productcategory_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_productcategory_history_compare_revisions',));
                                }

                                // admin_sonata_product_productcategory_acl
                                if (preg_match('#^/admin/sonata/product/productcategory/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_productcategory_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.product.admin.product.category',  '_sonata_name' => 'admin_sonata_product_productcategory_acl',));
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/sonata/product/productcollection')) {
                                // admin_sonata_product_productcollection_list
                                if ($pathinfo === '/admin/sonata/product/productcollection/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_productcollection_list',  '_route' => 'admin_sonata_product_productcollection_list',);
                                }

                                // admin_sonata_product_productcollection_create
                                if ($pathinfo === '/admin/sonata/product/productcollection/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_productcollection_create',  '_route' => 'admin_sonata_product_productcollection_create',);
                                }

                                // admin_sonata_product_productcollection_batch
                                if ($pathinfo === '/admin/sonata/product/productcollection/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_productcollection_batch',  '_route' => 'admin_sonata_product_productcollection_batch',);
                                }

                                // admin_sonata_product_productcollection_edit
                                if (preg_match('#^/admin/sonata/product/productcollection/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_productcollection_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_productcollection_edit',));
                                }

                                // admin_sonata_product_productcollection_delete
                                if (preg_match('#^/admin/sonata/product/productcollection/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_productcollection_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_productcollection_delete',));
                                }

                                // admin_sonata_product_productcollection_show
                                if (preg_match('#^/admin/sonata/product/productcollection/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_productcollection_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_productcollection_show',));
                                }

                                // admin_sonata_product_productcollection_export
                                if ($pathinfo === '/admin/sonata/product/productcollection/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_productcollection_export',  '_route' => 'admin_sonata_product_productcollection_export',);
                                }

                                // admin_sonata_product_productcollection_history
                                if (preg_match('#^/admin/sonata/product/productcollection/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_productcollection_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_productcollection_history',));
                                }

                                // admin_sonata_product_productcollection_history_view_revision
                                if (preg_match('#^/admin/sonata/product/productcollection/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_productcollection_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_productcollection_history_view_revision',));
                                }

                                // admin_sonata_product_productcollection_history_compare_revisions
                                if (preg_match('#^/admin/sonata/product/productcollection/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_productcollection_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_productcollection_history_compare_revisions',));
                                }

                                // admin_sonata_product_productcollection_acl
                                if (preg_match('#^/admin/sonata/product/productcollection/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_productcollection_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.product.admin.product.collection',  '_sonata_name' => 'admin_sonata_product_productcollection_acl',));
                                }

                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/product/delivery')) {
                            // admin_sonata_product_delivery_list
                            if ($pathinfo === '/admin/sonata/product/delivery/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_delivery_list',  '_route' => 'admin_sonata_product_delivery_list',);
                            }

                            // admin_sonata_product_delivery_create
                            if ($pathinfo === '/admin/sonata/product/delivery/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_delivery_create',  '_route' => 'admin_sonata_product_delivery_create',);
                            }

                            // admin_sonata_product_delivery_batch
                            if ($pathinfo === '/admin/sonata/product/delivery/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_delivery_batch',  '_route' => 'admin_sonata_product_delivery_batch',);
                            }

                            // admin_sonata_product_delivery_edit
                            if (preg_match('#^/admin/sonata/product/delivery/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_delivery_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_delivery_edit',));
                            }

                            // admin_sonata_product_delivery_delete
                            if (preg_match('#^/admin/sonata/product/delivery/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_delivery_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_delivery_delete',));
                            }

                            // admin_sonata_product_delivery_show
                            if (preg_match('#^/admin/sonata/product/delivery/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_delivery_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_delivery_show',));
                            }

                            // admin_sonata_product_delivery_export
                            if ($pathinfo === '/admin/sonata/product/delivery/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_delivery_export',  '_route' => 'admin_sonata_product_delivery_export',);
                            }

                            // admin_sonata_product_delivery_history
                            if (preg_match('#^/admin/sonata/product/delivery/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_delivery_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_delivery_history',));
                            }

                            // admin_sonata_product_delivery_history_view_revision
                            if (preg_match('#^/admin/sonata/product/delivery/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_delivery_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_delivery_history_view_revision',));
                            }

                            // admin_sonata_product_delivery_history_compare_revisions
                            if (preg_match('#^/admin/sonata/product/delivery/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_delivery_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_delivery_history_compare_revisions',));
                            }

                            // admin_sonata_product_delivery_acl
                            if (preg_match('#^/admin/sonata/product/delivery/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_product_delivery_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.product.admin.delivery',  '_sonata_name' => 'admin_sonata_product_delivery_acl',));
                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/sonata/c')) {
                        if (0 === strpos($pathinfo, '/admin/sonata/comment')) {
                            if (0 === strpos($pathinfo, '/admin/sonata/comment/comment')) {
                                // admin_sonata_comment_comment_list
                                if ($pathinfo === '/admin/sonata/comment/comment/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_comment_list',  '_route' => 'admin_sonata_comment_comment_list',);
                                }

                                // admin_sonata_comment_comment_create
                                if ($pathinfo === '/admin/sonata/comment/comment/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_comment_create',  '_route' => 'admin_sonata_comment_comment_create',);
                                }

                                // admin_sonata_comment_comment_batch
                                if ($pathinfo === '/admin/sonata/comment/comment/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_comment_batch',  '_route' => 'admin_sonata_comment_comment_batch',);
                                }

                                // admin_sonata_comment_comment_edit
                                if (preg_match('#^/admin/sonata/comment/comment/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_comment_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_comment_edit',));
                                }

                                // admin_sonata_comment_comment_delete
                                if (preg_match('#^/admin/sonata/comment/comment/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_comment_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_comment_delete',));
                                }

                                // admin_sonata_comment_comment_show
                                if (preg_match('#^/admin/sonata/comment/comment/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_comment_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_comment_show',));
                                }

                                // admin_sonata_comment_comment_export
                                if ($pathinfo === '/admin/sonata/comment/comment/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_comment_export',  '_route' => 'admin_sonata_comment_comment_export',);
                                }

                                // admin_sonata_comment_comment_history
                                if (preg_match('#^/admin/sonata/comment/comment/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_comment_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_comment_history',));
                                }

                                // admin_sonata_comment_comment_history_view_revision
                                if (preg_match('#^/admin/sonata/comment/comment/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_comment_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_comment_history_view_revision',));
                                }

                                // admin_sonata_comment_comment_history_compare_revisions
                                if (preg_match('#^/admin/sonata/comment/comment/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_comment_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_comment_history_compare_revisions',));
                                }

                                // admin_sonata_comment_comment_acl
                                if (preg_match('#^/admin/sonata/comment/comment/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_comment_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_comment_acl',));
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/sonata/comment/thread')) {
                                // admin_sonata_comment_thread_list
                                if ($pathinfo === '/admin/sonata/comment/thread/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.comment.admin.thread',  '_sonata_name' => 'admin_sonata_comment_thread_list',  '_route' => 'admin_sonata_comment_thread_list',);
                                }

                                // admin_sonata_comment_thread_create
                                if ($pathinfo === '/admin/sonata/comment/thread/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.comment.admin.thread',  '_sonata_name' => 'admin_sonata_comment_thread_create',  '_route' => 'admin_sonata_comment_thread_create',);
                                }

                                // admin_sonata_comment_thread_batch
                                if ($pathinfo === '/admin/sonata/comment/thread/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.comment.admin.thread',  '_sonata_name' => 'admin_sonata_comment_thread_batch',  '_route' => 'admin_sonata_comment_thread_batch',);
                                }

                                // admin_sonata_comment_thread_edit
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.comment.admin.thread',  '_sonata_name' => 'admin_sonata_comment_thread_edit',));
                                }

                                // admin_sonata_comment_thread_delete
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.comment.admin.thread',  '_sonata_name' => 'admin_sonata_comment_thread_delete',));
                                }

                                // admin_sonata_comment_thread_show
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.comment.admin.thread',  '_sonata_name' => 'admin_sonata_comment_thread_show',));
                                }

                                // admin_sonata_comment_thread_export
                                if ($pathinfo === '/admin/sonata/comment/thread/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.comment.admin.thread',  '_sonata_name' => 'admin_sonata_comment_thread_export',  '_route' => 'admin_sonata_comment_thread_export',);
                                }

                                // admin_sonata_comment_thread_history
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.comment.admin.thread',  '_sonata_name' => 'admin_sonata_comment_thread_history',));
                                }

                                // admin_sonata_comment_thread_history_view_revision
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.comment.admin.thread',  '_sonata_name' => 'admin_sonata_comment_thread_history_view_revision',));
                                }

                                // admin_sonata_comment_thread_history_compare_revisions
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.comment.admin.thread',  '_sonata_name' => 'admin_sonata_comment_thread_history_compare_revisions',));
                                }

                                // admin_sonata_comment_thread_acl
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.comment.admin.thread',  '_sonata_name' => 'admin_sonata_comment_thread_acl',));
                                }

                                // admin_sonata_comment_thread_comment_list
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/comment/list$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_comment_list')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.comment.admin.thread|sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_thread_comment_list',));
                                }

                                // admin_sonata_comment_thread_comment_create
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/comment/create$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_comment_create')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.comment.admin.thread|sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_thread_comment_create',));
                                }

                                // admin_sonata_comment_thread_comment_batch
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/comment/batch$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_comment_batch')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.comment.admin.thread|sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_thread_comment_batch',));
                                }

                                // admin_sonata_comment_thread_comment_edit
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/comment/(?P<childId>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_comment_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.comment.admin.thread|sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_thread_comment_edit',));
                                }

                                // admin_sonata_comment_thread_comment_delete
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/comment/(?P<childId>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_comment_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.comment.admin.thread|sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_thread_comment_delete',));
                                }

                                // admin_sonata_comment_thread_comment_show
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/comment/(?P<childId>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_comment_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.comment.admin.thread|sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_thread_comment_show',));
                                }

                                // admin_sonata_comment_thread_comment_export
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/comment/export$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_comment_export')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.comment.admin.thread|sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_thread_comment_export',));
                                }

                                // admin_sonata_comment_thread_comment_history
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/comment/(?P<childId>[^/]++)/history$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_comment_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.comment.admin.thread|sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_thread_comment_history',));
                                }

                                // admin_sonata_comment_thread_comment_history_view_revision
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/comment/(?P<childId>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_comment_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.comment.admin.thread|sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_thread_comment_history_view_revision',));
                                }

                                // admin_sonata_comment_thread_comment_history_compare_revisions
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/comment/(?P<childId>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_comment_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.comment.admin.thread|sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_thread_comment_history_compare_revisions',));
                                }

                                // admin_sonata_comment_thread_comment_acl
                                if (preg_match('#^/admin/sonata/comment/thread/(?P<id>[^/]++)/comment/(?P<childId>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_comment_thread_comment_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.comment.admin.thread|sonata.comment.admin.comment',  '_sonata_name' => 'admin_sonata_comment_thread_comment_acl',));
                                }

                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/classification')) {
                            if (0 === strpos($pathinfo, '/admin/sonata/classification/category')) {
                                // admin_sonata_classification_category_list
                                if ($pathinfo === '/admin/sonata/classification/category/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_list',  '_route' => 'admin_sonata_classification_category_list',);
                                }

                                // admin_sonata_classification_category_create
                                if ($pathinfo === '/admin/sonata/classification/category/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_create',  '_route' => 'admin_sonata_classification_category_create',);
                                }

                                // admin_sonata_classification_category_batch
                                if ($pathinfo === '/admin/sonata/classification/category/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_batch',  '_route' => 'admin_sonata_classification_category_batch',);
                                }

                                // admin_sonata_classification_category_edit
                                if (preg_match('#^/admin/sonata/classification/category/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_category_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_edit',));
                                }

                                // admin_sonata_classification_category_delete
                                if (preg_match('#^/admin/sonata/classification/category/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_category_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_delete',));
                                }

                                // admin_sonata_classification_category_show
                                if (preg_match('#^/admin/sonata/classification/category/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_category_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_show',));
                                }

                                // admin_sonata_classification_category_export
                                if ($pathinfo === '/admin/sonata/classification/category/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_export',  '_route' => 'admin_sonata_classification_category_export',);
                                }

                                // admin_sonata_classification_category_history
                                if (preg_match('#^/admin/sonata/classification/category/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_category_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_history',));
                                }

                                // admin_sonata_classification_category_history_view_revision
                                if (preg_match('#^/admin/sonata/classification/category/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_category_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_history_view_revision',));
                                }

                                // admin_sonata_classification_category_history_compare_revisions
                                if (preg_match('#^/admin/sonata/classification/category/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_category_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_history_compare_revisions',));
                                }

                                // admin_sonata_classification_category_acl
                                if (preg_match('#^/admin/sonata/classification/category/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_category_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.classification.admin.category',  '_sonata_name' => 'admin_sonata_classification_category_acl',));
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/sonata/classification/tag')) {
                                // admin_sonata_classification_tag_list
                                if ($pathinfo === '/admin/sonata/classification/tag/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_list',  '_route' => 'admin_sonata_classification_tag_list',);
                                }

                                // admin_sonata_classification_tag_create
                                if ($pathinfo === '/admin/sonata/classification/tag/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_create',  '_route' => 'admin_sonata_classification_tag_create',);
                                }

                                // admin_sonata_classification_tag_batch
                                if ($pathinfo === '/admin/sonata/classification/tag/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_batch',  '_route' => 'admin_sonata_classification_tag_batch',);
                                }

                                // admin_sonata_classification_tag_edit
                                if (preg_match('#^/admin/sonata/classification/tag/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_tag_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_edit',));
                                }

                                // admin_sonata_classification_tag_delete
                                if (preg_match('#^/admin/sonata/classification/tag/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_tag_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_delete',));
                                }

                                // admin_sonata_classification_tag_show
                                if (preg_match('#^/admin/sonata/classification/tag/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_tag_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_show',));
                                }

                                // admin_sonata_classification_tag_export
                                if ($pathinfo === '/admin/sonata/classification/tag/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_export',  '_route' => 'admin_sonata_classification_tag_export',);
                                }

                                // admin_sonata_classification_tag_history
                                if (preg_match('#^/admin/sonata/classification/tag/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_tag_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_history',));
                                }

                                // admin_sonata_classification_tag_history_view_revision
                                if (preg_match('#^/admin/sonata/classification/tag/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_tag_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_history_view_revision',));
                                }

                                // admin_sonata_classification_tag_history_compare_revisions
                                if (preg_match('#^/admin/sonata/classification/tag/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_tag_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_history_compare_revisions',));
                                }

                                // admin_sonata_classification_tag_acl
                                if (preg_match('#^/admin/sonata/classification/tag/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_tag_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.classification.admin.tag',  '_sonata_name' => 'admin_sonata_classification_tag_acl',));
                                }

                            }

                            if (0 === strpos($pathinfo, '/admin/sonata/classification/collection')) {
                                // admin_sonata_classification_collection_list
                                if ($pathinfo === '/admin/sonata/classification/collection/list') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_list',  '_route' => 'admin_sonata_classification_collection_list',);
                                }

                                // admin_sonata_classification_collection_create
                                if ($pathinfo === '/admin/sonata/classification/collection/create') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_create',  '_route' => 'admin_sonata_classification_collection_create',);
                                }

                                // admin_sonata_classification_collection_batch
                                if ($pathinfo === '/admin/sonata/classification/collection/batch') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_batch',  '_route' => 'admin_sonata_classification_collection_batch',);
                                }

                                // admin_sonata_classification_collection_edit
                                if (preg_match('#^/admin/sonata/classification/collection/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_collection_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_edit',));
                                }

                                // admin_sonata_classification_collection_delete
                                if (preg_match('#^/admin/sonata/classification/collection/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_collection_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_delete',));
                                }

                                // admin_sonata_classification_collection_show
                                if (preg_match('#^/admin/sonata/classification/collection/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_collection_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_show',));
                                }

                                // admin_sonata_classification_collection_export
                                if ($pathinfo === '/admin/sonata/classification/collection/export') {
                                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_export',  '_route' => 'admin_sonata_classification_collection_export',);
                                }

                                // admin_sonata_classification_collection_history
                                if (preg_match('#^/admin/sonata/classification/collection/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_collection_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_history',));
                                }

                                // admin_sonata_classification_collection_history_view_revision
                                if (preg_match('#^/admin/sonata/classification/collection/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_collection_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_history_view_revision',));
                                }

                                // admin_sonata_classification_collection_history_compare_revisions
                                if (preg_match('#^/admin/sonata/classification/collection/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_collection_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_history_compare_revisions',));
                                }

                                // admin_sonata_classification_collection_acl
                                if (preg_match('#^/admin/sonata/classification/collection/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_classification_collection_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.classification.admin.collection',  '_sonata_name' => 'admin_sonata_classification_collection_acl',));
                                }

                            }

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/sonata/notification/message')) {
                        // admin_sonata_notification_message_list
                        if ($pathinfo === '/admin/sonata/notification/message/list') {
                            return array (  '_controller' => 'Sonata\\NotificationBundle\\Controller\\MessageAdminController::listAction',  '_sonata_admin' => 'sonata.notification.admin.message',  '_sonata_name' => 'admin_sonata_notification_message_list',  '_route' => 'admin_sonata_notification_message_list',);
                        }

                        // admin_sonata_notification_message_batch
                        if ($pathinfo === '/admin/sonata/notification/message/batch') {
                            return array (  '_controller' => 'Sonata\\NotificationBundle\\Controller\\MessageAdminController::batchAction',  '_sonata_admin' => 'sonata.notification.admin.message',  '_sonata_name' => 'admin_sonata_notification_message_batch',  '_route' => 'admin_sonata_notification_message_batch',);
                        }

                        // admin_sonata_notification_message_delete
                        if (preg_match('#^/admin/sonata/notification/message/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_notification_message_delete')), array (  '_controller' => 'Sonata\\NotificationBundle\\Controller\\MessageAdminController::deleteAction',  '_sonata_admin' => 'sonata.notification.admin.message',  '_sonata_name' => 'admin_sonata_notification_message_delete',));
                        }

                        // admin_sonata_notification_message_show
                        if (preg_match('#^/admin/sonata/notification/message/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_notification_message_show')), array (  '_controller' => 'Sonata\\NotificationBundle\\Controller\\MessageAdminController::showAction',  '_sonata_admin' => 'sonata.notification.admin.message',  '_sonata_name' => 'admin_sonata_notification_message_show',));
                        }

                        // admin_sonata_notification_message_export
                        if ($pathinfo === '/admin/sonata/notification/message/export') {
                            return array (  '_controller' => 'Sonata\\NotificationBundle\\Controller\\MessageAdminController::exportAction',  '_sonata_admin' => 'sonata.notification.admin.message',  '_sonata_name' => 'admin_sonata_notification_message_export',  '_route' => 'admin_sonata_notification_message_export',);
                        }

                        // admin_sonata_notification_message_history_view_revision
                        if (preg_match('#^/admin/sonata/notification/message/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_notification_message_history_view_revision')), array (  '_controller' => 'Sonata\\NotificationBundle\\Controller\\MessageAdminController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.notification.admin.message',  '_sonata_name' => 'admin_sonata_notification_message_history_view_revision',));
                        }

                        // admin_sonata_notification_message_history_compare_revisions
                        if (preg_match('#^/admin/sonata/notification/message/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_notification_message_history_compare_revisions')), array (  '_controller' => 'Sonata\\NotificationBundle\\Controller\\MessageAdminController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.notification.admin.message',  '_sonata_name' => 'admin_sonata_notification_message_history_compare_revisions',));
                        }

                        // admin_sonata_notification_message_acl
                        if (preg_match('#^/admin/sonata/notification/message/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_notification_message_acl')), array (  '_controller' => 'Sonata\\NotificationBundle\\Controller\\MessageAdminController::aclAction',  '_sonata_admin' => 'sonata.notification.admin.message',  '_sonata_name' => 'admin_sonata_notification_message_acl',));
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/sonata/demo')) {
                        if (0 === strpos($pathinfo, '/admin/sonata/demo/car')) {
                            // admin_sonata_demo_car_list
                            if ($pathinfo === '/admin/sonata/demo/car/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.demo.admin.car',  '_sonata_name' => 'admin_sonata_demo_car_list',  '_route' => 'admin_sonata_demo_car_list',);
                            }

                            // admin_sonata_demo_car_create
                            if ($pathinfo === '/admin/sonata/demo/car/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.demo.admin.car',  '_sonata_name' => 'admin_sonata_demo_car_create',  '_route' => 'admin_sonata_demo_car_create',);
                            }

                            // admin_sonata_demo_car_batch
                            if ($pathinfo === '/admin/sonata/demo/car/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.demo.admin.car',  '_sonata_name' => 'admin_sonata_demo_car_batch',  '_route' => 'admin_sonata_demo_car_batch',);
                            }

                            // admin_sonata_demo_car_edit
                            if (preg_match('#^/admin/sonata/demo/car/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_car_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.demo.admin.car',  '_sonata_name' => 'admin_sonata_demo_car_edit',));
                            }

                            // admin_sonata_demo_car_delete
                            if (preg_match('#^/admin/sonata/demo/car/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_car_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.demo.admin.car',  '_sonata_name' => 'admin_sonata_demo_car_delete',));
                            }

                            // admin_sonata_demo_car_show
                            if (preg_match('#^/admin/sonata/demo/car/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_car_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.demo.admin.car',  '_sonata_name' => 'admin_sonata_demo_car_show',));
                            }

                            // admin_sonata_demo_car_export
                            if ($pathinfo === '/admin/sonata/demo/car/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.demo.admin.car',  '_sonata_name' => 'admin_sonata_demo_car_export',  '_route' => 'admin_sonata_demo_car_export',);
                            }

                            // admin_sonata_demo_car_history
                            if (preg_match('#^/admin/sonata/demo/car/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_car_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.demo.admin.car',  '_sonata_name' => 'admin_sonata_demo_car_history',));
                            }

                            // admin_sonata_demo_car_history_view_revision
                            if (preg_match('#^/admin/sonata/demo/car/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_car_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.demo.admin.car',  '_sonata_name' => 'admin_sonata_demo_car_history_view_revision',));
                            }

                            // admin_sonata_demo_car_history_compare_revisions
                            if (preg_match('#^/admin/sonata/demo/car/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_car_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.demo.admin.car',  '_sonata_name' => 'admin_sonata_demo_car_history_compare_revisions',));
                            }

                            // admin_sonata_demo_car_acl
                            if (preg_match('#^/admin/sonata/demo/car/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_car_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.demo.admin.car',  '_sonata_name' => 'admin_sonata_demo_car_acl',));
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/demo/engine')) {
                            // admin_sonata_demo_engine_list
                            if ($pathinfo === '/admin/sonata/demo/engine/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.demo.admin.engine',  '_sonata_name' => 'admin_sonata_demo_engine_list',  '_route' => 'admin_sonata_demo_engine_list',);
                            }

                            // admin_sonata_demo_engine_create
                            if ($pathinfo === '/admin/sonata/demo/engine/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.demo.admin.engine',  '_sonata_name' => 'admin_sonata_demo_engine_create',  '_route' => 'admin_sonata_demo_engine_create',);
                            }

                            // admin_sonata_demo_engine_batch
                            if ($pathinfo === '/admin/sonata/demo/engine/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.demo.admin.engine',  '_sonata_name' => 'admin_sonata_demo_engine_batch',  '_route' => 'admin_sonata_demo_engine_batch',);
                            }

                            // admin_sonata_demo_engine_edit
                            if (preg_match('#^/admin/sonata/demo/engine/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_engine_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.demo.admin.engine',  '_sonata_name' => 'admin_sonata_demo_engine_edit',));
                            }

                            // admin_sonata_demo_engine_delete
                            if (preg_match('#^/admin/sonata/demo/engine/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_engine_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.demo.admin.engine',  '_sonata_name' => 'admin_sonata_demo_engine_delete',));
                            }

                            // admin_sonata_demo_engine_show
                            if (preg_match('#^/admin/sonata/demo/engine/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_engine_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.demo.admin.engine',  '_sonata_name' => 'admin_sonata_demo_engine_show',));
                            }

                            // admin_sonata_demo_engine_export
                            if ($pathinfo === '/admin/sonata/demo/engine/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.demo.admin.engine',  '_sonata_name' => 'admin_sonata_demo_engine_export',  '_route' => 'admin_sonata_demo_engine_export',);
                            }

                            // admin_sonata_demo_engine_history
                            if (preg_match('#^/admin/sonata/demo/engine/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_engine_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.demo.admin.engine',  '_sonata_name' => 'admin_sonata_demo_engine_history',));
                            }

                            // admin_sonata_demo_engine_history_view_revision
                            if (preg_match('#^/admin/sonata/demo/engine/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_engine_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.demo.admin.engine',  '_sonata_name' => 'admin_sonata_demo_engine_history_view_revision',));
                            }

                            // admin_sonata_demo_engine_history_compare_revisions
                            if (preg_match('#^/admin/sonata/demo/engine/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_engine_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.demo.admin.engine',  '_sonata_name' => 'admin_sonata_demo_engine_history_compare_revisions',));
                            }

                            // admin_sonata_demo_engine_acl
                            if (preg_match('#^/admin/sonata/demo/engine/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_engine_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.demo.admin.engine',  '_sonata_name' => 'admin_sonata_demo_engine_acl',));
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/demo/inspection')) {
                            // admin_sonata_demo_inspection_list
                            if ($pathinfo === '/admin/sonata/demo/inspection/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.demo.admin.inspection',  '_sonata_name' => 'admin_sonata_demo_inspection_list',  '_route' => 'admin_sonata_demo_inspection_list',);
                            }

                            // admin_sonata_demo_inspection_create
                            if ($pathinfo === '/admin/sonata/demo/inspection/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.demo.admin.inspection',  '_sonata_name' => 'admin_sonata_demo_inspection_create',  '_route' => 'admin_sonata_demo_inspection_create',);
                            }

                            // admin_sonata_demo_inspection_batch
                            if ($pathinfo === '/admin/sonata/demo/inspection/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.demo.admin.inspection',  '_sonata_name' => 'admin_sonata_demo_inspection_batch',  '_route' => 'admin_sonata_demo_inspection_batch',);
                            }

                            // admin_sonata_demo_inspection_edit
                            if (preg_match('#^/admin/sonata/demo/inspection/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_inspection_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.demo.admin.inspection',  '_sonata_name' => 'admin_sonata_demo_inspection_edit',));
                            }

                            // admin_sonata_demo_inspection_delete
                            if (preg_match('#^/admin/sonata/demo/inspection/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_inspection_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.demo.admin.inspection',  '_sonata_name' => 'admin_sonata_demo_inspection_delete',));
                            }

                            // admin_sonata_demo_inspection_show
                            if (preg_match('#^/admin/sonata/demo/inspection/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_inspection_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.demo.admin.inspection',  '_sonata_name' => 'admin_sonata_demo_inspection_show',));
                            }

                            // admin_sonata_demo_inspection_export
                            if ($pathinfo === '/admin/sonata/demo/inspection/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.demo.admin.inspection',  '_sonata_name' => 'admin_sonata_demo_inspection_export',  '_route' => 'admin_sonata_demo_inspection_export',);
                            }

                            // admin_sonata_demo_inspection_history
                            if (preg_match('#^/admin/sonata/demo/inspection/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_inspection_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.demo.admin.inspection',  '_sonata_name' => 'admin_sonata_demo_inspection_history',));
                            }

                            // admin_sonata_demo_inspection_history_view_revision
                            if (preg_match('#^/admin/sonata/demo/inspection/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_inspection_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.demo.admin.inspection',  '_sonata_name' => 'admin_sonata_demo_inspection_history_view_revision',));
                            }

                            // admin_sonata_demo_inspection_history_compare_revisions
                            if (preg_match('#^/admin/sonata/demo/inspection/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_inspection_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.demo.admin.inspection',  '_sonata_name' => 'admin_sonata_demo_inspection_history_compare_revisions',));
                            }

                            // admin_sonata_demo_inspection_acl
                            if (preg_match('#^/admin/sonata/demo/inspection/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_inspection_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.demo.admin.inspection',  '_sonata_name' => 'admin_sonata_demo_inspection_acl',));
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/demo/color')) {
                            // admin_sonata_demo_color_list
                            if ($pathinfo === '/admin/sonata/demo/color/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.demo.admin.color',  '_sonata_name' => 'admin_sonata_demo_color_list',  '_route' => 'admin_sonata_demo_color_list',);
                            }

                            // admin_sonata_demo_color_create
                            if ($pathinfo === '/admin/sonata/demo/color/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.demo.admin.color',  '_sonata_name' => 'admin_sonata_demo_color_create',  '_route' => 'admin_sonata_demo_color_create',);
                            }

                            // admin_sonata_demo_color_batch
                            if ($pathinfo === '/admin/sonata/demo/color/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.demo.admin.color',  '_sonata_name' => 'admin_sonata_demo_color_batch',  '_route' => 'admin_sonata_demo_color_batch',);
                            }

                            // admin_sonata_demo_color_edit
                            if (preg_match('#^/admin/sonata/demo/color/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_color_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.demo.admin.color',  '_sonata_name' => 'admin_sonata_demo_color_edit',));
                            }

                            // admin_sonata_demo_color_delete
                            if (preg_match('#^/admin/sonata/demo/color/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_color_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.demo.admin.color',  '_sonata_name' => 'admin_sonata_demo_color_delete',));
                            }

                            // admin_sonata_demo_color_show
                            if (preg_match('#^/admin/sonata/demo/color/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_color_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.demo.admin.color',  '_sonata_name' => 'admin_sonata_demo_color_show',));
                            }

                            // admin_sonata_demo_color_export
                            if ($pathinfo === '/admin/sonata/demo/color/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.demo.admin.color',  '_sonata_name' => 'admin_sonata_demo_color_export',  '_route' => 'admin_sonata_demo_color_export',);
                            }

                            // admin_sonata_demo_color_history
                            if (preg_match('#^/admin/sonata/demo/color/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_color_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.demo.admin.color',  '_sonata_name' => 'admin_sonata_demo_color_history',));
                            }

                            // admin_sonata_demo_color_history_view_revision
                            if (preg_match('#^/admin/sonata/demo/color/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_color_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.demo.admin.color',  '_sonata_name' => 'admin_sonata_demo_color_history_view_revision',));
                            }

                            // admin_sonata_demo_color_history_compare_revisions
                            if (preg_match('#^/admin/sonata/demo/color/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_color_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.demo.admin.color',  '_sonata_name' => 'admin_sonata_demo_color_history_compare_revisions',));
                            }

                            // admin_sonata_demo_color_acl
                            if (preg_match('#^/admin/sonata/demo/color/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_color_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.demo.admin.color',  '_sonata_name' => 'admin_sonata_demo_color_acl',));
                            }

                        }

                        if (0 === strpos($pathinfo, '/admin/sonata/demo/material')) {
                            // admin_sonata_demo_material_list
                            if ($pathinfo === '/admin/sonata/demo/material/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.demo.admin.material',  '_sonata_name' => 'admin_sonata_demo_material_list',  '_route' => 'admin_sonata_demo_material_list',);
                            }

                            // admin_sonata_demo_material_create
                            if ($pathinfo === '/admin/sonata/demo/material/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.demo.admin.material',  '_sonata_name' => 'admin_sonata_demo_material_create',  '_route' => 'admin_sonata_demo_material_create',);
                            }

                            // admin_sonata_demo_material_batch
                            if ($pathinfo === '/admin/sonata/demo/material/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.demo.admin.material',  '_sonata_name' => 'admin_sonata_demo_material_batch',  '_route' => 'admin_sonata_demo_material_batch',);
                            }

                            // admin_sonata_demo_material_edit
                            if (preg_match('#^/admin/sonata/demo/material/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_material_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.demo.admin.material',  '_sonata_name' => 'admin_sonata_demo_material_edit',));
                            }

                            // admin_sonata_demo_material_delete
                            if (preg_match('#^/admin/sonata/demo/material/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_material_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.demo.admin.material',  '_sonata_name' => 'admin_sonata_demo_material_delete',));
                            }

                            // admin_sonata_demo_material_show
                            if (preg_match('#^/admin/sonata/demo/material/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_material_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.demo.admin.material',  '_sonata_name' => 'admin_sonata_demo_material_show',));
                            }

                            // admin_sonata_demo_material_export
                            if ($pathinfo === '/admin/sonata/demo/material/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.demo.admin.material',  '_sonata_name' => 'admin_sonata_demo_material_export',  '_route' => 'admin_sonata_demo_material_export',);
                            }

                            // admin_sonata_demo_material_history
                            if (preg_match('#^/admin/sonata/demo/material/(?P<id>[^/]++)/history$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_material_history')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyAction',  '_sonata_admin' => 'sonata.demo.admin.material',  '_sonata_name' => 'admin_sonata_demo_material_history',));
                            }

                            // admin_sonata_demo_material_history_view_revision
                            if (preg_match('#^/admin/sonata/demo/material/(?P<id>[^/]++)/history/(?P<revision>[^/]++)/view$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_material_history_view_revision')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyViewRevisionAction',  '_sonata_admin' => 'sonata.demo.admin.material',  '_sonata_name' => 'admin_sonata_demo_material_history_view_revision',));
                            }

                            // admin_sonata_demo_material_history_compare_revisions
                            if (preg_match('#^/admin/sonata/demo/material/(?P<id>[^/]++)/history/(?P<base_revision>[^/]++)/(?P<compare_revision>[^/]++)/compare$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_material_history_compare_revisions')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::historyCompareRevisionsAction',  '_sonata_admin' => 'sonata.demo.admin.material',  '_sonata_name' => 'admin_sonata_demo_material_history_compare_revisions',));
                            }

                            // admin_sonata_demo_material_acl
                            if (preg_match('#^/admin/sonata/demo/material/(?P<id>[^/]++)/acl$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_demo_material_acl')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::aclAction',  '_sonata_admin' => 'sonata.demo.admin.material',  '_sonata_name' => 'admin_sonata_demo_material_acl',));
                            }

                        }

                    }

                }

                if (0 === strpos($pathinfo, '/admin/log')) {
                    if (0 === strpos($pathinfo, '/admin/login')) {
                        // sonata_user_admin_security_login
                        if ($pathinfo === '/admin/login') {
                            return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\AdminSecurityController::loginAction',  '_route' => 'sonata_user_admin_security_login',);
                        }

                        // sonata_user_admin_security_check
                        if ($pathinfo === '/admin/login_check') {
                            return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\AdminSecurityController::checkAction',  '_route' => 'sonata_user_admin_security_check',);
                        }

                    }

                    // sonata_user_admin_security_logout
                    if ($pathinfo === '/admin/logout') {
                        return array (  '_controller' => 'Sonata\\UserBundle\\Controller\\AdminSecurityController::logoutAction',  '_route' => 'sonata_user_admin_security_logout',);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/media/pixlr')) {
                    // sonata_media_pixlr_edit
                    if (0 === strpos($pathinfo, '/admin/media/pixlr/edit') && preg_match('#^/admin/media/pixlr/edit/(?P<id>[^/]++)/(?P<mode>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_media_pixlr_edit')), array (  '_controller' => 'sonata.media.extra.pixlr:editAction',));
                    }

                    // sonata_media_pixlr_target
                    if (0 === strpos($pathinfo, '/admin/media/pixlr/target') && preg_match('#^/admin/media/pixlr/target/(?P<hash>[^/]++)/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_media_pixlr_target')), array (  '_controller' => 'sonata.media.extra.pixlr:targetAction',));
                    }

                    // sonata_media_pixlr_exit
                    if (0 === strpos($pathinfo, '/admin/media/pixlr/exit') && preg_match('#^/admin/media/pixlr/exit/(?P<hash>[^/]++)/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_media_pixlr_exit')), array (  '_controller' => 'sonata.media.extra.pixlr:exitAction',));
                    }

                    // sonata_media_pixlr_open_editor
                    if (0 === strpos($pathinfo, '/admin/media/pixlr/open') && preg_match('#^/admin/media/pixlr/open/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_media_pixlr_open_editor')), array (  '_controller' => 'sonata.media.extra.pixlr:openEditorAction',));
                    }

                }

            }

            if (0 === strpos($pathinfo, '/api')) {
                // nelmio_api_doc_index
                if (rtrim($pathinfo, '/') === '/api/doc') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_nelmio_api_doc_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'nelmio_api_doc_index');
                    }

                    return array (  '_controller' => 'Nelmio\\ApiDocBundle\\Controller\\ApiDocController::indexAction',  '_route' => 'nelmio_api_doc_index',);
                }
                not_nelmio_api_doc_index:

                if (0 === strpos($pathinfo, '/api/classification')) {
                    if (0 === strpos($pathinfo, '/api/classification/c')) {
                        if (0 === strpos($pathinfo, '/api/classification/categories')) {
                            // sonata_api_classification_category_get_categories
                            if (preg_match('#^/api/classification/categories(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_sonata_api_classification_category_get_categories;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_category_get_categories')), array (  '_controller' => 'sonata.classification.controller.api.category:getCategoriesAction',  '_format' => NULL,));
                            }
                            not_sonata_api_classification_category_get_categories:

                            // sonata_api_classification_category_get_category
                            if (preg_match('#^/api/classification/categories/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_sonata_api_classification_category_get_category;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_category_get_category')), array (  '_controller' => 'sonata.classification.controller.api.category:getCategoryAction',  '_format' => NULL,));
                            }
                            not_sonata_api_classification_category_get_category:

                            // sonata_api_classification_category_post_category
                            if (preg_match('#^/api/classification/categories(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_sonata_api_classification_category_post_category;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_category_post_category')), array (  '_controller' => 'sonata.classification.controller.api.category:postCategoryAction',  '_format' => NULL,));
                            }
                            not_sonata_api_classification_category_post_category:

                            // sonata_api_classification_category_put_category
                            if (preg_match('#^/api/classification/categories/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'PUT') {
                                    $allow[] = 'PUT';
                                    goto not_sonata_api_classification_category_put_category;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_category_put_category')), array (  '_controller' => 'sonata.classification.controller.api.category:putCategoryAction',  '_format' => NULL,));
                            }
                            not_sonata_api_classification_category_put_category:

                            // sonata_api_classification_category_delete_category
                            if (preg_match('#^/api/classification/categories/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'DELETE') {
                                    $allow[] = 'DELETE';
                                    goto not_sonata_api_classification_category_delete_category;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_category_delete_category')), array (  '_controller' => 'sonata.classification.controller.api.category:deleteCategoryAction',  '_format' => NULL,));
                            }
                            not_sonata_api_classification_category_delete_category:

                        }

                        if (0 === strpos($pathinfo, '/api/classification/collections')) {
                            // sonata_api_classification_collection_get_collections
                            if (preg_match('#^/api/classification/collections(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_sonata_api_classification_collection_get_collections;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_collection_get_collections')), array (  '_controller' => 'sonata.classification.controller.api.collection:getCollectionsAction',  '_format' => NULL,));
                            }
                            not_sonata_api_classification_collection_get_collections:

                            // sonata_api_classification_collection_get_collection
                            if (preg_match('#^/api/classification/collections/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_sonata_api_classification_collection_get_collection;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_collection_get_collection')), array (  '_controller' => 'sonata.classification.controller.api.collection:getCollectionAction',  '_format' => NULL,));
                            }
                            not_sonata_api_classification_collection_get_collection:

                            // sonata_api_classification_collection_post_collection
                            if (preg_match('#^/api/classification/collections(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_sonata_api_classification_collection_post_collection;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_collection_post_collection')), array (  '_controller' => 'sonata.classification.controller.api.collection:postCollectionAction',  '_format' => NULL,));
                            }
                            not_sonata_api_classification_collection_post_collection:

                            // sonata_api_classification_collection_put_collection
                            if (preg_match('#^/api/classification/collections/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'PUT') {
                                    $allow[] = 'PUT';
                                    goto not_sonata_api_classification_collection_put_collection;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_collection_put_collection')), array (  '_controller' => 'sonata.classification.controller.api.collection:putCollectionAction',  '_format' => NULL,));
                            }
                            not_sonata_api_classification_collection_put_collection:

                            // sonata_api_classification_collection_delete_collection
                            if (preg_match('#^/api/classification/collections/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'DELETE') {
                                    $allow[] = 'DELETE';
                                    goto not_sonata_api_classification_collection_delete_collection;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_collection_delete_collection')), array (  '_controller' => 'sonata.classification.controller.api.collection:deleteCollectionAction',  '_format' => NULL,));
                            }
                            not_sonata_api_classification_collection_delete_collection:

                        }

                    }

                    if (0 === strpos($pathinfo, '/api/classification/tags')) {
                        // sonata_api_classification_tag_get_tags
                        if (preg_match('#^/api/classification/tags(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_classification_tag_get_tags;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_tag_get_tags')), array (  '_controller' => 'sonata.classification.controller.api.tag:getTagsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_classification_tag_get_tags:

                        // sonata_api_classification_tag_get_tag
                        if (preg_match('#^/api/classification/tags/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_classification_tag_get_tag;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_tag_get_tag')), array (  '_controller' => 'sonata.classification.controller.api.tag:getTagAction',  '_format' => NULL,));
                        }
                        not_sonata_api_classification_tag_get_tag:

                        // sonata_api_classification_tag_post_tag
                        if (preg_match('#^/api/classification/tags(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_sonata_api_classification_tag_post_tag;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_tag_post_tag')), array (  '_controller' => 'sonata.classification.controller.api.tag:postTagAction',  '_format' => NULL,));
                        }
                        not_sonata_api_classification_tag_post_tag:

                        // sonata_api_classification_tag_put_tag
                        if (preg_match('#^/api/classification/tags/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_sonata_api_classification_tag_put_tag;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_tag_put_tag')), array (  '_controller' => 'sonata.classification.controller.api.tag:putTagAction',  '_format' => NULL,));
                        }
                        not_sonata_api_classification_tag_put_tag:

                        // sonata_api_classification_tag_delete_tag
                        if (preg_match('#^/api/classification/tags/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_sonata_api_classification_tag_delete_tag;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_classification_tag_delete_tag')), array (  '_controller' => 'sonata.classification.controller.api.tag:deleteTagAction',  '_format' => NULL,));
                        }
                        not_sonata_api_classification_tag_delete_tag:

                    }

                }

                if (0 === strpos($pathinfo, '/api/news')) {
                    if (0 === strpos($pathinfo, '/api/news/posts')) {
                        // sonata_api_news_post_get_posts
                        if (preg_match('#^/api/news/posts(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_news_post_get_posts;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_news_post_get_posts')), array (  '_controller' => 'sonata.news.controller.api.post:getPostsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_news_post_get_posts:

                        // sonata_api_news_post_get_post
                        if (preg_match('#^/api/news/posts/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_news_post_get_post;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_news_post_get_post')), array (  '_controller' => 'sonata.news.controller.api.post:getPostAction',  '_format' => NULL,));
                        }
                        not_sonata_api_news_post_get_post:

                        // sonata_api_news_post_post_post
                        if (preg_match('#^/api/news/posts(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_sonata_api_news_post_post_post;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_news_post_post_post')), array (  '_controller' => 'sonata.news.controller.api.post:postPostAction',  '_format' => NULL,));
                        }
                        not_sonata_api_news_post_post_post:

                        // sonata_api_news_post_put_post
                        if (preg_match('#^/api/news/posts/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_sonata_api_news_post_put_post;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_news_post_put_post')), array (  '_controller' => 'sonata.news.controller.api.post:putPostAction',  '_format' => NULL,));
                        }
                        not_sonata_api_news_post_put_post:

                        // sonata_api_news_post_delete_post
                        if (preg_match('#^/api/news/posts/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_sonata_api_news_post_delete_post;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_news_post_delete_post')), array (  '_controller' => 'sonata.news.controller.api.post:deletePostAction',  '_format' => NULL,));
                        }
                        not_sonata_api_news_post_delete_post:

                        // sonata_api_news_post_get_post_comments
                        if (preg_match('#^/api/news/posts/(?P<id>[^/]++)/comments(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_news_post_get_post_comments;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_news_post_get_post_comments')), array (  '_controller' => 'sonata.news.controller.api.post:getPostCommentsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_news_post_get_post_comments:

                        // sonata_api_news_post_post_post_comments
                        if (preg_match('#^/api/news/posts/(?P<id>[^/]++)/comments(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_sonata_api_news_post_post_post_comments;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_news_post_post_post_comments')), array (  '_controller' => 'sonata.news.controller.api.post:postPostCommentsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_news_post_post_post_comments:

                        // sonata_api_news_post_put_post_comments
                        if (preg_match('#^/api/news/posts/(?P<postId>[^/]++)/comments/(?P<commentId>[^/\\.]++)(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_sonata_api_news_post_put_post_comments;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_news_post_put_post_comments')), array (  '_controller' => 'sonata.news.controller.api.post:putPostCommentsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_news_post_put_post_comments:

                    }

                    if (0 === strpos($pathinfo, '/api/news/comments')) {
                        // sonata_api_news_comment_get_comment
                        if (preg_match('#^/api/news/comments/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_news_comment_get_comment;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_news_comment_get_comment')), array (  '_controller' => 'sonata.news.controller.api.comment:getCommentAction',  '_format' => NULL,));
                        }
                        not_sonata_api_news_comment_get_comment:

                        // sonata_api_news_comment_delete_comment
                        if (preg_match('#^/api/news/comments/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_sonata_api_news_comment_delete_comment;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_news_comment_delete_comment')), array (  '_controller' => 'sonata.news.controller.api.comment:deleteCommentAction',  '_format' => NULL,));
                        }
                        not_sonata_api_news_comment_delete_comment:

                    }

                }

                if (0 === strpos($pathinfo, '/api/media')) {
                    if (0 === strpos($pathinfo, '/api/media/galleries')) {
                        // sonata_api_media_gallery_get_galleries
                        if (preg_match('#^/api/media/galleries(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_media_gallery_get_galleries;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_gallery_get_galleries')), array (  '_controller' => 'sonata.media.controller.api.gallery:getGalleriesAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_gallery_get_galleries:

                        // sonata_api_media_gallery_get_gallery
                        if (preg_match('#^/api/media/galleries/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_media_gallery_get_gallery;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_gallery_get_gallery')), array (  '_controller' => 'sonata.media.controller.api.gallery:getGalleryAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_gallery_get_gallery:

                        // sonata_api_media_gallery_get_gallery_medias
                        if (preg_match('#^/api/media/galleries/(?P<id>[^/]++)/medias(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_media_gallery_get_gallery_medias;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_gallery_get_gallery_medias')), array (  '_controller' => 'sonata.media.controller.api.gallery:getGalleryMediasAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_gallery_get_gallery_medias:

                        // sonata_api_media_gallery_get_gallery_galleryhasmedias
                        if (preg_match('#^/api/media/galleries/(?P<id>[^/]++)/galleryhasmedias(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_media_gallery_get_gallery_galleryhasmedias;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_gallery_get_gallery_galleryhasmedias')), array (  '_controller' => 'sonata.media.controller.api.gallery:getGalleryGalleryhasmediasAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_gallery_get_gallery_galleryhasmedias:

                        // sonata_api_media_gallery_post_gallery
                        if (preg_match('#^/api/media/galleries(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_sonata_api_media_gallery_post_gallery;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_gallery_post_gallery')), array (  '_controller' => 'sonata.media.controller.api.gallery:postGalleryAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_gallery_post_gallery:

                        // sonata_api_media_gallery_put_gallery
                        if (preg_match('#^/api/media/galleries/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_sonata_api_media_gallery_put_gallery;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_gallery_put_gallery')), array (  '_controller' => 'sonata.media.controller.api.gallery:putGalleryAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_gallery_put_gallery:

                        // sonata_api_media_gallery_post_gallery_media_galleryhasmedia
                        if (preg_match('#^/api/media/galleries/(?P<galleryId>[^/]++)/media/(?P<mediaId>[^/]++)/galleryhasmedia(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_sonata_api_media_gallery_post_gallery_media_galleryhasmedia;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_gallery_post_gallery_media_galleryhasmedia')), array (  '_controller' => 'sonata.media.controller.api.gallery:postGalleryMediaGalleryhasmediaAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_gallery_post_gallery_media_galleryhasmedia:

                        // sonata_api_media_gallery_put_gallery_media_galleryhasmedia
                        if (preg_match('#^/api/media/galleries/(?P<galleryId>[^/]++)/media/(?P<mediaId>[^/]++)/galleryhasmedia(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_sonata_api_media_gallery_put_gallery_media_galleryhasmedia;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_gallery_put_gallery_media_galleryhasmedia')), array (  '_controller' => 'sonata.media.controller.api.gallery:putGalleryMediaGalleryhasmediaAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_gallery_put_gallery_media_galleryhasmedia:

                        // sonata_api_media_gallery_delete_gallery_media_galleryhasmedia
                        if (preg_match('#^/api/media/galleries/(?P<galleryId>[^/]++)/media/(?P<mediaId>[^/]++)/galleryhasmedia(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_sonata_api_media_gallery_delete_gallery_media_galleryhasmedia;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_gallery_delete_gallery_media_galleryhasmedia')), array (  '_controller' => 'sonata.media.controller.api.gallery:deleteGalleryMediaGalleryhasmediaAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_gallery_delete_gallery_media_galleryhasmedia:

                        // sonata_api_media_gallery_delete_gallery
                        if (preg_match('#^/api/media/galleries/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_sonata_api_media_gallery_delete_gallery;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_gallery_delete_gallery')), array (  '_controller' => 'sonata.media.controller.api.gallery:deleteGalleryAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_gallery_delete_gallery:

                    }

                    if (0 === strpos($pathinfo, '/api/media/media')) {
                        // sonata_api_media_media_get_media
                        if (preg_match('#^/api/media/media(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_media_media_get_media;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_media_get_media')), array (  '_controller' => 'sonata.media.controller.api.media:getMediaAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_media_get_media:

                        // sonata_api_media_media_get_medium
                        if (preg_match('#^/api/media/media/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_media_media_get_medium;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_media_get_medium')), array (  '_controller' => 'sonata.media.controller.api.media:getMediumAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_media_get_medium:

                        // sonata_api_media_media_get_medium_formats
                        if (preg_match('#^/api/media/media/(?P<id>[^/]++)/formats(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_media_media_get_medium_formats;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_media_get_medium_formats')), array (  '_controller' => 'sonata.media.controller.api.media:getMediumFormatsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_media_get_medium_formats:

                        // sonata_api_media_media_get_medium_binary
                        if (preg_match('#^/api/media/media/(?P<id>[^/]++)/binaries/(?P<format>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_media_media_get_medium_binary;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_media_get_medium_binary')), array (  '_controller' => 'sonata.media.controller.api.media:getMediumBinaryAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_media_get_medium_binary:

                        // sonata_api_media_media_delete_medium
                        if (preg_match('#^/api/media/media/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_sonata_api_media_media_delete_medium;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_media_delete_medium')), array (  '_controller' => 'sonata.media.controller.api.media:deleteMediumAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_media_delete_medium:

                        // sonata_api_media_media_put_medium
                        if (preg_match('#^/api/media/media/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_sonata_api_media_media_put_medium;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_media_put_medium')), array (  '_controller' => 'sonata.media.controller.api.media:putMediumAction',  '_format' => NULL,));
                        }
                        not_sonata_api_media_media_put_medium:

                    }

                    // sonata_api_media_media_post_provider_medium
                    if (0 === strpos($pathinfo, '/api/media/providers') && preg_match('#^/api/media/providers/(?P<provider>[A-Za-z0-9.]*)/media(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_sonata_api_media_media_post_provider_medium;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_media_media_post_provider_medium')), array (  '_controller' => 'sonata.media.controller.api.media:postProviderMediumAction',  '_format' => NULL,));
                    }
                    not_sonata_api_media_media_post_provider_medium:

                }

                // sonata_api_notification_message_get_messages
                if (0 === strpos($pathinfo, '/api/notification/messages') && preg_match('#^/api/notification/messages(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_sonata_api_notification_message_get_messages;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_notification_message_get_messages')), array (  '_controller' => 'sonata.notification.controller.api.message:getMessagesAction',  '_format' => NULL,));
                }
                not_sonata_api_notification_message_get_messages:

                if (0 === strpos($pathinfo, '/api/ecommerce')) {
                    if (0 === strpos($pathinfo, '/api/ecommerce/products')) {
                        // sonata_api_ecommerce_product_get_products
                        if (preg_match('#^/api/ecommerce/products(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_product_get_products;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_product_get_products')), array (  '_controller' => 'sonata.product.controller.api.product:getProductsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_product_get_products:

                        // sonata_api_ecommerce_product_get_product
                        if (preg_match('#^/api/ecommerce/products/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_product_get_product;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_product_get_product')), array (  '_controller' => 'sonata.product.controller.api.product:getProductAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_product_get_product:

                    }

                    // sonata_api_ecommerce_product_post_product
                    if (preg_match('#^/api/ecommerce/(?P<provider>[^/]++)/products(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_sonata_api_ecommerce_product_post_product;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_product_post_product')), array (  '_controller' => 'sonata.product.controller.api.product:postProductAction',  '_format' => NULL,));
                    }
                    not_sonata_api_ecommerce_product_post_product:

                    // sonata_api_ecommerce_product_put_product
                    if (preg_match('#^/api/ecommerce/(?P<provider>[^/]++)/products/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_sonata_api_ecommerce_product_put_product;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_product_put_product')), array (  '_controller' => 'sonata.product.controller.api.product:putProductAction',  '_format' => NULL,));
                    }
                    not_sonata_api_ecommerce_product_put_product:

                    if (0 === strpos($pathinfo, '/api/ecommerce/products')) {
                        // sonata_api_ecommerce_product_delete_product
                        if (preg_match('#^/api/ecommerce/products/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_sonata_api_ecommerce_product_delete_product;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_product_delete_product')), array (  '_controller' => 'sonata.product.controller.api.product:deleteProductAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_product_delete_product:

                        // sonata_api_ecommerce_product_get_product_productcategories
                        if (preg_match('#^/api/ecommerce/products/(?P<id>[^/]++)/productcategories(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_product_get_product_productcategories;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_product_get_product_productcategories')), array (  '_controller' => 'sonata.product.controller.api.product:getProductProductcategoriesAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_product_get_product_productcategories:

                        // sonata_api_ecommerce_product_get_product_categories
                        if (preg_match('#^/api/ecommerce/products/(?P<id>[^/]++)/categories(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_product_get_product_categories;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_product_get_product_categories')), array (  '_controller' => 'sonata.product.controller.api.product:getProductCategoriesAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_product_get_product_categories:

                        // sonata_api_ecommerce_product_get_product_productcollections
                        if (preg_match('#^/api/ecommerce/products/(?P<id>[^/]++)/productcollections(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_product_get_product_productcollections;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_product_get_product_productcollections')), array (  '_controller' => 'sonata.product.controller.api.product:getProductProductcollectionsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_product_get_product_productcollections:

                        // sonata_api_ecommerce_product_get_product_collections
                        if (preg_match('#^/api/ecommerce/products/(?P<id>[^/]++)/collections(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_product_get_product_collections;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_product_get_product_collections')), array (  '_controller' => 'sonata.product.controller.api.product:getProductCollectionsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_product_get_product_collections:

                        // sonata_api_ecommerce_product_get_product_deliveries
                        if (preg_match('#^/api/ecommerce/products/(?P<id>[^/]++)/deliveries(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_product_get_product_deliveries;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_product_get_product_deliveries')), array (  '_controller' => 'sonata.product.controller.api.product:getProductDeliveriesAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_product_get_product_deliveries:

                        // sonata_api_ecommerce_product_get_product_packages
                        if (preg_match('#^/api/ecommerce/products/(?P<id>[^/]++)/packages(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_product_get_product_packages;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_product_get_product_packages')), array (  '_controller' => 'sonata.product.controller.api.product:getProductPackagesAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_product_get_product_packages:

                        // sonata_api_ecommerce_product_get_product_variations
                        if (preg_match('#^/api/ecommerce/products/(?P<id>[^/]++)/variations(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_product_get_product_variations;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_product_get_product_variations')), array (  '_controller' => 'sonata.product.controller.api.product:getProductVariationsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_product_get_product_variations:

                    }

                    if (0 === strpos($pathinfo, '/api/ecommerce/orders')) {
                        // sonata_api_ecommerce_order_get_orders
                        if (preg_match('#^/api/ecommerce/orders(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_order_get_orders;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_order_get_orders')), array (  '_controller' => 'sonata.order.controller.api.order:getOrdersAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_order_get_orders:

                        // sonata_api_ecommerce_order_get_order
                        if (preg_match('#^/api/ecommerce/orders/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_order_get_order;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_order_get_order')), array (  '_controller' => 'sonata.order.controller.api.order:getOrderAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_order_get_order:

                        // sonata_api_ecommerce_order_get_order_orderelements
                        if (preg_match('#^/api/ecommerce/orders/(?P<id>[^/]++)/orderelements(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_order_get_order_orderelements;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_order_get_order_orderelements')), array (  '_controller' => 'sonata.order.controller.api.order:getOrderOrderelementsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_order_get_order_orderelements:

                    }

                    if (0 === strpos($pathinfo, '/api/ecommerce/invoices')) {
                        // sonata_api_ecommerce_invoice_get_invoices
                        if (preg_match('#^/api/ecommerce/invoices(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_invoice_get_invoices;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_invoice_get_invoices')), array (  '_controller' => 'sonata.invoice.controller.api.invoice:getInvoicesAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_invoice_get_invoices:

                        // sonata_api_ecommerce_invoice_get_invoice
                        if (preg_match('#^/api/ecommerce/invoices/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_invoice_get_invoice;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_invoice_get_invoice')), array (  '_controller' => 'sonata.invoice.controller.api.invoice:getInvoiceAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_invoice_get_invoice:

                        // sonata_api_ecommerce_invoice_get_invoice_invoiceelements
                        if (preg_match('#^/api/ecommerce/invoices/(?P<id>[^/]++)/invoiceelements(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_invoice_get_invoice_invoiceelements;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_invoice_get_invoice_invoiceelements')), array (  '_controller' => 'sonata.invoice.controller.api.invoice:getInvoiceInvoiceelementsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_invoice_get_invoice_invoiceelements:

                    }

                    if (0 === strpos($pathinfo, '/api/ecommerce/addresses')) {
                        // sonata_api_ecommerce_address_get_addresses
                        if (preg_match('#^/api/ecommerce/addresses(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_address_get_addresses;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_address_get_addresses')), array (  '_controller' => 'sonata.customer.controller.api.address:getAddressesAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_address_get_addresses:

                        // sonata_api_ecommerce_address_get_address
                        if (preg_match('#^/api/ecommerce/addresses/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_address_get_address;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_address_get_address')), array (  '_controller' => 'sonata.customer.controller.api.address:getAddressAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_address_get_address:

                        // sonata_api_ecommerce_address_post_address
                        if (preg_match('#^/api/ecommerce/addresses(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_sonata_api_ecommerce_address_post_address;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_address_post_address')), array (  '_controller' => 'sonata.customer.controller.api.address:postAddressAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_address_post_address:

                        // sonata_api_ecommerce_address_put_address
                        if (preg_match('#^/api/ecommerce/addresses/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_sonata_api_ecommerce_address_put_address;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_address_put_address')), array (  '_controller' => 'sonata.customer.controller.api.address:putAddressAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_address_put_address:

                        // sonata_api_ecommerce_address_delete_address
                        if (preg_match('#^/api/ecommerce/addresses/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_sonata_api_ecommerce_address_delete_address;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_address_delete_address')), array (  '_controller' => 'sonata.customer.controller.api.address:deleteAddressAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_address_delete_address:

                    }

                    if (0 === strpos($pathinfo, '/api/ecommerce/customers')) {
                        // sonata_api_ecommerce_customer_get_customers
                        if (preg_match('#^/api/ecommerce/customers(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_customer_get_customers;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_customer_get_customers')), array (  '_controller' => 'sonata.customer.controller.api.customer:getCustomersAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_customer_get_customers:

                        // sonata_api_ecommerce_customer_get_customer
                        if (preg_match('#^/api/ecommerce/customers/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_customer_get_customer;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_customer_get_customer')), array (  '_controller' => 'sonata.customer.controller.api.customer:getCustomerAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_customer_get_customer:

                        // sonata_api_ecommerce_customer_post_customer
                        if (preg_match('#^/api/ecommerce/customers(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_sonata_api_ecommerce_customer_post_customer;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_customer_post_customer')), array (  '_controller' => 'sonata.customer.controller.api.customer:postCustomerAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_customer_post_customer:

                        // sonata_api_ecommerce_customer_put_customer
                        if (preg_match('#^/api/ecommerce/customers/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_sonata_api_ecommerce_customer_put_customer;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_customer_put_customer')), array (  '_controller' => 'sonata.customer.controller.api.customer:putCustomerAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_customer_put_customer:

                        // sonata_api_ecommerce_customer_delete_customer
                        if (preg_match('#^/api/ecommerce/customers/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_sonata_api_ecommerce_customer_delete_customer;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_customer_delete_customer')), array (  '_controller' => 'sonata.customer.controller.api.customer:deleteCustomerAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_customer_delete_customer:

                        // sonata_api_ecommerce_customer_get_customer_orders
                        if (preg_match('#^/api/ecommerce/customers/(?P<id>[^/]++)/orders(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_customer_get_customer_orders;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_customer_get_customer_orders')), array (  '_controller' => 'sonata.customer.controller.api.customer:getCustomerOrdersAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_customer_get_customer_orders:

                        // sonata_api_ecommerce_customer_get_customer_addresses
                        if (preg_match('#^/api/ecommerce/customers/(?P<id>[^/]++)/addresses(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_customer_get_customer_addresses;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_customer_get_customer_addresses')), array (  '_controller' => 'sonata.customer.controller.api.customer:getCustomerAddressesAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_customer_get_customer_addresses:

                        // sonata_api_ecommerce_customer_post_customer_address
                        if (preg_match('#^/api/ecommerce/customers/(?P<id>[^/]++)/addresses(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_sonata_api_ecommerce_customer_post_customer_address;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_customer_post_customer_address')), array (  '_controller' => 'sonata.customer.controller.api.customer:postCustomerAddressAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_customer_post_customer_address:

                    }

                    if (0 === strpos($pathinfo, '/api/ecommerce/baskets')) {
                        // sonata_api_ecommerce_basket_get_baskets
                        if (preg_match('#^/api/ecommerce/baskets(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_basket_get_baskets;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_basket_get_baskets')), array (  '_controller' => 'sonata.basket.controller.api.basket:getBasketsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_basket_get_baskets:

                        // sonata_api_ecommerce_basket_get_basket
                        if (preg_match('#^/api/ecommerce/baskets/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_basket_get_basket;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_basket_get_basket')), array (  '_controller' => 'sonata.basket.controller.api.basket:getBasketAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_basket_get_basket:

                        // sonata_api_ecommerce_basket_get_basket_basketelements
                        if (preg_match('#^/api/ecommerce/baskets/(?P<id>[^/]++)/basketelements(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_ecommerce_basket_get_basket_basketelements;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_basket_get_basket_basketelements')), array (  '_controller' => 'sonata.basket.controller.api.basket:getBasketBasketelementsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_basket_get_basket_basketelements:

                        // sonata_api_ecommerce_basket_post_basket
                        if (preg_match('#^/api/ecommerce/baskets(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_sonata_api_ecommerce_basket_post_basket;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_basket_post_basket')), array (  '_controller' => 'sonata.basket.controller.api.basket:postBasketAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_basket_post_basket:

                        // sonata_api_ecommerce_basket_put_basket
                        if (preg_match('#^/api/ecommerce/baskets/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_sonata_api_ecommerce_basket_put_basket;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_basket_put_basket')), array (  '_controller' => 'sonata.basket.controller.api.basket:putBasketAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_basket_put_basket:

                        // sonata_api_ecommerce_basket_delete_basket
                        if (preg_match('#^/api/ecommerce/baskets/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_sonata_api_ecommerce_basket_delete_basket;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_basket_delete_basket')), array (  '_controller' => 'sonata.basket.controller.api.basket:deleteBasketAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_basket_delete_basket:

                        // sonata_api_ecommerce_basket_post_basket_basketelements
                        if (preg_match('#^/api/ecommerce/baskets/(?P<id>[^/]++)/basketelements(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_sonata_api_ecommerce_basket_post_basket_basketelements;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_basket_post_basket_basketelements')), array (  '_controller' => 'sonata.basket.controller.api.basket:postBasketBasketelementsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_basket_post_basket_basketelements:

                        // sonata_api_ecommerce_basket_put_basket_basketelements
                        if (preg_match('#^/api/ecommerce/baskets/(?P<basketId>[^/]++)/basketelements/(?P<elementId>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_sonata_api_ecommerce_basket_put_basket_basketelements;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_basket_put_basket_basketelements')), array (  '_controller' => 'sonata.basket.controller.api.basket:putBasketBasketelementsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_basket_put_basket_basketelements:

                        // sonata_api_ecommerce_basket_delete_basket_basketelements
                        if (preg_match('#^/api/ecommerce/baskets/(?P<basketId>[^/]++)/basketelements/(?P<elementId>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_sonata_api_ecommerce_basket_delete_basket_basketelements;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_ecommerce_basket_delete_basket_basketelements')), array (  '_controller' => 'sonata.basket.controller.api.basket:deleteBasketBasketelementsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_ecommerce_basket_delete_basket_basketelements:

                    }

                }

                if (0 === strpos($pathinfo, '/api/page')) {
                    if (0 === strpos($pathinfo, '/api/page/blocks')) {
                        // sonata_api_block_get_block
                        if (preg_match('#^/api/page/blocks/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_block_get_block;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_block_get_block')), array (  '_controller' => 'sonata.page.controller.api.block:getBlockAction',  '_format' => NULL,));
                        }
                        not_sonata_api_block_get_block:

                        // sonata_api_block_put_block
                        if (preg_match('#^/api/page/blocks/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_sonata_api_block_put_block;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_block_put_block')), array (  '_controller' => 'sonata.page.controller.api.block:putBlockAction',  '_format' => NULL,));
                        }
                        not_sonata_api_block_put_block:

                        // sonata_api_block_delete_block
                        if (preg_match('#^/api/page/blocks/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_sonata_api_block_delete_block;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_block_delete_block')), array (  '_controller' => 'sonata.page.controller.api.block:deleteBlockAction',  '_format' => NULL,));
                        }
                        not_sonata_api_block_delete_block:

                    }

                    if (0 === strpos($pathinfo, '/api/page/pages')) {
                        // sonata_api_page_get_pages
                        if (preg_match('#^/api/page/pages(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_page_get_pages;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_page_get_pages')), array (  '_controller' => 'sonata.page.controller.api.page:getPagesAction',  '_format' => NULL,));
                        }
                        not_sonata_api_page_get_pages:

                        // sonata_api_page_get_page
                        if (preg_match('#^/api/page/pages/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_page_get_page;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_page_get_page')), array (  '_controller' => 'sonata.page.controller.api.page:getPageAction',  '_format' => NULL,));
                        }
                        not_sonata_api_page_get_page:

                        // sonata_api_page_get_page_blocks
                        if (preg_match('#^/api/page/pages/(?P<id>[^/]++)/blocks(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_page_get_page_blocks;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_page_get_page_blocks')), array (  '_controller' => 'sonata.page.controller.api.page:getPageBlocksAction',  '_format' => NULL,));
                        }
                        not_sonata_api_page_get_page_blocks:

                        // sonata_api_page_get_page_pages
                        if (preg_match('#^/api/page/pages/(?P<id>[^/]++)/pages(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_page_get_page_pages;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_page_get_page_pages')), array (  '_controller' => 'sonata.page.controller.api.page:getPagePagesAction',  '_format' => NULL,));
                        }
                        not_sonata_api_page_get_page_pages:

                        // sonata_api_page_post_page_block
                        if (preg_match('#^/api/page/pages/(?P<id>[^/]++)/blocks(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_sonata_api_page_post_page_block;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_page_post_page_block')), array (  '_controller' => 'sonata.page.controller.api.page:postPageBlockAction',  '_format' => NULL,));
                        }
                        not_sonata_api_page_post_page_block:

                        // sonata_api_page_post_page
                        if (preg_match('#^/api/page/pages(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_sonata_api_page_post_page;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_page_post_page')), array (  '_controller' => 'sonata.page.controller.api.page:postPageAction',  '_format' => NULL,));
                        }
                        not_sonata_api_page_post_page:

                        // sonata_api_page_put_page
                        if (preg_match('#^/api/page/pages/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_sonata_api_page_put_page;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_page_put_page')), array (  '_controller' => 'sonata.page.controller.api.page:putPageAction',  '_format' => NULL,));
                        }
                        not_sonata_api_page_put_page:

                        // sonata_api_page_delete_page
                        if (preg_match('#^/api/page/pages/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_sonata_api_page_delete_page;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_page_delete_page')), array (  '_controller' => 'sonata.page.controller.api.page:deletePageAction',  '_format' => NULL,));
                        }
                        not_sonata_api_page_delete_page:

                        // sonata_api_page_post_page_snapshot
                        if (preg_match('#^/api/page/pages/(?P<id>[^/]++)/snapshots(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_sonata_api_page_post_page_snapshot;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_page_post_page_snapshot')), array (  '_controller' => 'sonata.page.controller.api.page:postPageSnapshotAction',  '_format' => NULL,));
                        }
                        not_sonata_api_page_post_page_snapshot:

                        // sonata_api_page_post_pages_snapshots
                        if (0 === strpos($pathinfo, '/api/page/pages/snapshots') && preg_match('#^/api/page/pages/snapshots(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_sonata_api_page_post_pages_snapshots;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_page_post_pages_snapshots')), array (  '_controller' => 'sonata.page.controller.api.page:postPagesSnapshotsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_page_post_pages_snapshots:

                    }

                    if (0 === strpos($pathinfo, '/api/page/s')) {
                        if (0 === strpos($pathinfo, '/api/page/sites')) {
                            // sonata_api_site_get_sites
                            if (preg_match('#^/api/page/sites(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_sonata_api_site_get_sites;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_site_get_sites')), array (  '_controller' => 'sonata.page.controller.api.site:getSitesAction',  '_format' => NULL,));
                            }
                            not_sonata_api_site_get_sites:

                            // sonata_api_site_get_site
                            if (preg_match('#^/api/page/sites/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_sonata_api_site_get_site;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_site_get_site')), array (  '_controller' => 'sonata.page.controller.api.site:getSiteAction',  '_format' => NULL,));
                            }
                            not_sonata_api_site_get_site:

                            // sonata_api_site_post_site
                            if (preg_match('#^/api/page/sites(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_sonata_api_site_post_site;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_site_post_site')), array (  '_controller' => 'sonata.page.controller.api.site:postSiteAction',  '_format' => NULL,));
                            }
                            not_sonata_api_site_post_site:

                            // sonata_api_site_put_site
                            if (preg_match('#^/api/page/sites/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'PUT') {
                                    $allow[] = 'PUT';
                                    goto not_sonata_api_site_put_site;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_site_put_site')), array (  '_controller' => 'sonata.page.controller.api.site:putSiteAction',  '_format' => NULL,));
                            }
                            not_sonata_api_site_put_site:

                            // sonata_api_site_delete_site
                            if (preg_match('#^/api/page/sites/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'DELETE') {
                                    $allow[] = 'DELETE';
                                    goto not_sonata_api_site_delete_site;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_site_delete_site')), array (  '_controller' => 'sonata.page.controller.api.site:deleteSiteAction',  '_format' => NULL,));
                            }
                            not_sonata_api_site_delete_site:

                        }

                        if (0 === strpos($pathinfo, '/api/page/snapshots')) {
                            // sonata_api_snapshot_get_snapshots
                            if (preg_match('#^/api/page/snapshots(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_sonata_api_snapshot_get_snapshots;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_snapshot_get_snapshots')), array (  '_controller' => 'sonata.page.controller.api.snapshot:getSnapshotsAction',  '_format' => NULL,));
                            }
                            not_sonata_api_snapshot_get_snapshots:

                            // sonata_api_snapshot_get_snapshot
                            if (preg_match('#^/api/page/snapshots/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_sonata_api_snapshot_get_snapshot;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_snapshot_get_snapshot')), array (  '_controller' => 'sonata.page.controller.api.snapshot:getSnapshotAction',  '_format' => NULL,));
                            }
                            not_sonata_api_snapshot_get_snapshot:

                            // sonata_api_snapshot_delete_snapshot
                            if (preg_match('#^/api/page/snapshots/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'DELETE') {
                                    $allow[] = 'DELETE';
                                    goto not_sonata_api_snapshot_delete_snapshot;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_snapshot_delete_snapshot')), array (  '_controller' => 'sonata.page.controller.api.snapshot:deleteSnapshotAction',  '_format' => NULL,));
                            }
                            not_sonata_api_snapshot_delete_snapshot:

                        }

                    }

                }

                if (0 === strpos($pathinfo, '/api/user')) {
                    if (0 === strpos($pathinfo, '/api/user/users')) {
                        // sonata_api_user_user_get_users
                        if (preg_match('#^/api/user/users(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_user_user_get_users;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_user_user_get_users')), array (  '_controller' => 'sonata.user.controller.api.user:getUsersAction',  '_format' => NULL,));
                        }
                        not_sonata_api_user_user_get_users:

                        // sonata_api_user_user_get_user
                        if (preg_match('#^/api/user/users/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_user_user_get_user;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_user_user_get_user')), array (  '_controller' => 'sonata.user.controller.api.user:getUserAction',  '_format' => NULL,));
                        }
                        not_sonata_api_user_user_get_user:

                    }

                    if (0 === strpos($pathinfo, '/api/user/groups')) {
                        // sonata_api_user_group_get_groups
                        if (preg_match('#^/api/user/groups(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_user_group_get_groups;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_user_group_get_groups')), array (  '_controller' => 'sonata.user.controller.api.group:getGroupsAction',  '_format' => NULL,));
                        }
                        not_sonata_api_user_group_get_groups:

                        // sonata_api_user_group_get_group
                        if (preg_match('#^/api/user/groups/(?P<id>[^/\\.]++)(?:\\.(?P<_format>json|xml|html))?$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_sonata_api_user_group_get_group;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_api_user_group_get_group')), array (  '_controller' => 'sonata.user.controller.api.group:getGroupAction',  '_format' => NULL,));
                        }
                        not_sonata_api_user_group_get_group:

                    }

                }

            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}

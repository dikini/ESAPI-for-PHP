<?php
/**
 * OWASP Enterprise Security API (ESAPI)
 *
 * This file is part of the Open Web Application Security Project (OWASP)
 * Enterprise Security API (ESAPI) project. For details, please see
 * <a href="http://www.owasp.org/index.php/ESAPI">http://www.owasp.org/index.php/ESAPI</a>.
 *
 * Copyright (c) 2007 - 2009 The OWASP Foundation
 *
 * The ESAPI is published by OWASP under the BSD license. You should read and accept the
 * LICENSE before you use, modify, and/or redistribute this software.
 *
 * @author
 * @created 2008
 * @since 1.4
 * @package ESAPI_Reference
 */

require_once dirname(__FILE__).'/../AccessController.php';

/**
 * Reference Implementation of the FileBasedAccessController interface.
 *
 * @category  OWASP
 * @package   ESAPI_Reference
 * @copyright 2009-2010 The OWASP Foundation
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD license
 * @version   Release: @package_version@
 * @link      http://www.owasp.org/index.php/ESAPI
 */
class FileBasedAccessController implements AccessController
{

    /**
     * Checks if an account is authorized to access the referenced URL.
     * Generally, this method should be invoked in the application's controller
     * or a filter as follows:
     * <code>ESAPI::getAccessController()->isAuthorizedForURL($_SERVER['REQUEST_URI']);</code>
     *
     * The implementation of this method should call assertAuthorizedForURL($url),
     * and if an AccessControlException is not thrown, this method should return
     * true. This way, if the user is not authorized, false would be returned,
     * and the exception would be logged.
     *
     * @param string $url the URL as returned by $_SERVER['REQUEST_URI']
     * @throws AccessControlException if access is not permitted
     * @return true, if is authorized for URL
     */
    public function isAuthorizedForURL($url)
    {
        throw new EnterpriseSecurityException("Method Not implemented");
    }

    /**
     * Checks if an account is authorized to access the referenced function.
     *
     * The implementation of this method should call
     * assertAuthorizedForFunction($functionName), and if an
     * AccessControlException is not thrown, this method should return true.
     *
     * @param string $functionName the name of the function
     * @throws AccessControlException if access is not permitted
     * @return true, if is authorized for function
     */
    public function isAuthorizedForFunction($functionName)
    {
        throw new EnterpriseSecurityException("Method Not implemented");
    }

    /**
     * Checks if an account is authorized to access the referenced data,
     * represented as a string.
     *
     * The implementation of this method should call assertAuthorizedForData($key),
     * and if an AccessControlException is not thrown, this method should return
     * true.
     *
     * @param string $key the name of the referenced data object
     * @throws AccessControlException if access is not permitted
     * @return true, if is authorized for the data
     */
    public function isAuthorizedForDataByKey($key)
    {
        throw new EnterpriseSecurityException("Method Not implemented");
    }

    /**
     * Checks if an account is authorized to access the referenced data,
     * represented as an object.
     *
     * The implementation of this method should call
     * assertAuthorizedForData($action, $data), and if an AccessControlException
     * is not thrown, this method should return true.
     *
     * @param string $action the action to check for in the configuration file
     *                       in the resource directory
     *
     * @param mixed $data    the data to check for in the configuration file in
     *                       the resource directory
     * @throws AccessControlException if access is not permitted
     * @return true, if is authorized for the data
     */
    public function isAuthorizedForData($action, $data)
    {
        throw new EnterpriseSecurityException("Method Not implemented");
    }

    /**
     * Checks if an account is authorized to access the referenced file.
     *
     * The implementation of this method should call
     * assertAuthorizedForFile($filepath), and if an AccessControlException is
     * not thrown, this method should return true.
     *
     * @param string $filepath the path of the file to be checked, including
     *                         filename
     * @throws AccessControlException if access is not permitted
     * @return true, if is authorized for the file
     */
    public function isAuthorizedForFile($filepath)
    {
        throw new EnterpriseSecurityException("Method Not implemented");
    }

    /**
     * Checks if an account is authorized to access the referenced service. This
     * can be used in applications that provide access to a variety of back end
     * services.
     *
     * The implementation of this method should call
     * assertAuthorizedForService($serviceName), and if an
     * AccessControlException is not thrown, this method should return true.
     *
     * @param string $serviceName the service name
     * @throws AccessControlException if access is not permitted
     * @return true, if is authorized for the service
     */
    public function isAuthorizedForService($serviceName)
    {
        throw new EnterpriseSecurityException("Method Not implemented");
    }

    /**
     * Checks if an account is authorized to access the referenced URL. The
     * implementation should allow access to be granted to any part of the URL.
     * Generally, this method should be invoked in the application's controller
     * or a filter as follows:
     * <code>ESAPI::getAccessController()->assertAuthorizedForURL($_SERVER['REQUEST_URI']);</code>
     *
     * This method throws an AccessControlException if access is not authorized,
     * or if the referenced URL does not exist. If the User is authorized, this
     * method simply returns.
     * <p>
     * Specification:  The implementation should do the following:
     * <ol>
     * <li>Check to see if the resource exists and if not, throw an AccessControlException</li>
     * <li>Use available information to make an access control decision</li>
     *      <ol type="a">
     *      <li>Ideally, this policy would be data driven</li>
     * 		<li>You can use the current User, roles, data type, data name, time of day, etc.</li>
     *  	<li>Access control decisions must deny by default</li>
     *      </ol>
     * <li>If access is not permitted, throw an AccessControlException with details</li>
     * </ol>
     * @param string $url the URL as returned by $_SERVER['REQUEST_URI']
     * @return this does not return a value.
     * @throws AccessControlException if access is not permitted
     */
    public function assertAuthorizedForURL($url)
    {
        throw new EnterpriseSecurityException("Method Not implemented");
    }

    /**
     * Checks if an account is authorized to access the referenced function. The
     * implementation should define the function "namespace" to be enforced.
     * Choosing something simple like the class name of action classes or menu
     * item names will make this implementation easier to use.
     * <p>
     * This method throws an AccessControlException if access is not authorized,
     * or if the referenced function does not exist. If the User is authorized,
     * this method simply returns.
     * <p>
     * Specification:  The implementation should do the following:
     * <ol>
     * <li>Check to see if the function exists and if not, throw an AccessControlException</li>
     * <li>Use available information to make an access control decision</li>
     *      <ol type="a">
     *      <li>Ideally, this policy would be data driven</li>
     * 		<li>You can use the current User, roles, data type, data name, time of day, etc.</li>
     *  	<li>Access control decisions must deny by default</li>
     *      </ol>
     * <li>If access is not permitted, throw an AccessControlException with details</li>
     * </ol>
     *
     * @param string $functionName the function name
     * @return this does not return a value.
     * @throws AccessControlException if access is not permitted
     */
    public function assertAuthorizedForFunction($functionName)
    {
        throw new EnterpriseSecurityException("Method Not implemented");
    }

    /**
     * Checks if the current user is authorized to access the referenced data.
     * This method simply returns if access is authorized. It throws an
     * AccessControlException if access is not authorized, or if the referenced
     * data does not exist.
     * <p>
     * Specification:  The implementation should do the following:
     * <ol>
     * <li>Check to see if the resource exists and if not, throw an AccessControlException</li>
     * <li>Use available information to make an access control decision</li>
     *      <ol type="a">
     *      <li>Ideally, this policy would be data driven</li>
     * 		<li>You can use the current User, roles, data type, data name, time of day, etc.</li>
     *  	<li>Access control decisions must deny by default</li>
     *      </ol>
     * <li>If access is not permitted, throw an AccessControlException with details</li>
     * </ol>
     * @param string $key the name of the target data object
     * @return this does not return a value.
     * @throws AccessControlException if access is not permitted
     */
    public function assertAuthorizedForDataByKey($key)
    {
        throw new EnterpriseSecurityException("Method Not implemented");
    }

    /**
     * Checks if the current user is authorized to access the referenced data.
     * This method simply returns if access is authorized. It throws an
     * AccessControlException if access is not authorized, or if the referenced
     * data does not exist.
     * <p>
     * Specification:  The implementation should do the following:
     * <ol>
     * <li>Check to see if the resource exists and if not, throw an AccessControlException</li>
     * <li>Use available information to make an access control decision</li>
     *      <ol type="a">
     *      <li>Ideally, this policy would be data driven</li>
     * 		<li>You can use the current User, roles, data type, data name, time of day, etc.</li>
     *  	<li>Access control decisions must deny by default</li>
     *      </ol>
     * <li>If access is not permitted, throw an AccessControlException with details</li>
     * </ol>
     *
     * @param string $action the action to check for in the configuration file
     *                       in the resource directory
     *
     * @param mixed  $data   the data to check for in the configuration file in
     *                       the resource directory
     * @return this does not return a value.
     * @throws AccessControlException if access is not permitted
     */
    public function assertAuthorizedForData($action, $data)
    {
        throw new EnterpriseSecurityException("Method Not implemented");
    }

    /**
     * Checks if an account is authorized to access the referenced file. The
     * implementation should validate and canonicalize the input to be sure the
     * filepath is not malicious.
     * <p>
     * This method throws an AccessControlException if access is not authorized,
     * or if the referenced File does not exist. If the User is authorized, this
     * method simply returns.
     * <p>
     * Specification:  The implementation should do the following:
     * <ol>
     * <li>Check to see if the File exists and if not, throw an AccessControlException</li>
     * <li>Use available information to make an access control decision</li>
     *      <ol type="a">
     *      <li>Ideally, this policy would be data driven</li>
     * 		<li>You can use the current User, roles, data type, data name, time of day, etc.</li>
     *  	<li>Access control decisions must deny by default</li>
     *      </ol>
     * <li>If access is not permitted, throw an AccessControlException with details</li>
     * </ol>
     *
     * @param string $filepath Path to the file to be checked
     * @throws AccessControlException if access is denied
     * @return this does not return a value.
     */
    public function assertAuthorizedForFile($filepath)
    {
        throw new EnterpriseSecurityException("Method Not implemented");
    }

    /**
     * Checks if an account is authorized to access the referenced service. This
     * can be used in applications that provide access to a variety of backend
     * services.
     * <p>
     * This method throws an AccessControlException if access is not authorized,
     * or if the referenced service does not exist. If the User is authorized,
     * this method simply returns.
     * <p>
     * Specification:  The implementation should do the following:
     * <ol>
     * <li>Check to see if the service exists and if not, throw an AccessControlException</li>
     * <li>Use available information to make an access control decision</li>
     *      <ol type="a">
     *      <li>Ideally, this policy would be data driven</li>
     * 		<li>You can use the current User, roles, data type, data name, time of day, etc.</li>
     *  	<li>Access control decisions must deny by default</li>
     *      </ol>
     * <li>If access is not permitted, throw an AccessControlException with details</li>
     * </ol>
     *
     * @param string $serviceName the service name
     * @return this does not return a value.
     * @throws AccessControlException if access is not permitted
     */
    public function assertAuthorizedForService($serviceName)
    {
		throw new EnterpriseSecurityException("Method Not implemented");
	}

}
?>
<?php
/**
 * OWASP Enterprise Security API (ESAPI)
 *
 * This file is part of the Open Web Application Security Project (OWASP)
 * Enterprise Security API (ESAPI) project.
<<<<<<< HEAD
 *
=======
 * 
>>>>>>> ca3ccc0e08db78df895196bfadefbdf8fa586ded
 * PHP version 5.2
 *
 * LICENSE: This source file is subject to the New BSD license.  You should read
 * and accept the LICENSE before you use, modify, and/or redistribute this
 * software.
 *
 * @category  OWASP
 * @package   ESAPI
 * @author    Andrew van der Stock <vanderaj@owasp.org>
 * @author    Mike Boberski <boberski_michael@bah.com>
 * @copyright 2009-2010 The OWASP Foundation
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD license
 * @version   SVN: $Id$
 * @link      http://www.owasp.org/index.php/ESAPI
 */

require_once dirname(__FILE__) . '/errors/AccessControlException.php';

/**
 * Use this ESAPI security control to create access reference maps.
<<<<<<< HEAD
 *
 * The idea behind this interface is to map a set of internal direct
 * object references to a set of indirect references that are safe to
 * disclose publicly. This can be used to help protect database keys,
 * filenames, and other types of direct object references. As a rule,
 * developers should not expose their direct object references as it
=======
 * 
 * The idea behind this interface is to map a set of internal direct 
 * object references to a set of indirect references that are safe to
 * disclose publicly. This can be used to help protect database keys,
 * filenames, and other types of direct object references. As a rule, 
 * developers should not expose their direct object references as it 
>>>>>>> ca3ccc0e08db78df895196bfadefbdf8fa586ded
 * enables attackers to attempt to manipulate them.
 *
 * @category  OWASP
 * @package   ESAPI
 * @author    Andrew van der Stock <vanderaj@owasp.org>
 * @author    Mike Boberski <boberski_michael@bah.com>
 * @copyright 2009-2010 The OWASP Foundation
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD license
 * @version   Release: @package_version@
 * @link      http://www.owasp.org/index.php/ESAPI
 */
interface AccessReferenceMap
{

    /**
<<<<<<< HEAD
     * Get an iterator through the direct object references. No guarantee is
     * made as  to the order of items returned.
     *
     * @return Iterator the iterator
=======
     * Get an iterator through the direct object references. No guarantee is made as 
     * to the order of items returned.
     * 
     * @return iterator the iterator
>>>>>>> ca3ccc0e08db78df895196bfadefbdf8fa586ded
     */
    function iterator();

    /**
     * Get a safe indirect reference to use in place of a potentially sensitive
     * direct object reference. Developers should use this call when building
     * URL's, form fields, hidden fields, etc... to help protect their private
     * implementation information.
<<<<<<< HEAD
     *
     * @param string $directReference the direct reference
     *
=======
     * 
     * @param string $directReference the direct reference
     * 
>>>>>>> ca3ccc0e08db78df895196bfadefbdf8fa586ded
     * @return string the indirect reference
     */
    function getIndirectReference($directReference);

    /**
     * Get the original direct object reference from an indirect reference.
     * Developers should use this when they get an indirect reference from a
     * request to translate it back into the real direct reference. If an
<<<<<<< HEAD
     * invalid indirect reference is requested, then an AccessControlException
     * is thrown.
     *
     * @param string $indirectReference the indirect reference
     *
     * @return string the direct reference
     *
     * @throws AccessControlException if no direct reference exists for the
=======
     * invalid indirect reference is requested, then an AccessControlException is
     * thrown.
     * 
     * @param string $indirectReference the indirect reference
     * 
     * @return string the direct reference
     * 
     * @throws AccessControlException if no direct reference exists for the 
>>>>>>> ca3ccc0e08db78df895196bfadefbdf8fa586ded
     *                                specified indirect reference
     */
    function getDirectReference($indirectReference);

    /**
<<<<<<< HEAD
     * Adds a direct reference to the AccessReferenceMap, then generates and
     * returns an associated indirect reference.
     *
     * @param string $direct the direct reference
     *
=======
     * Adds a direct reference to the AccessReferenceMap, then generates and returns 
     * an associated indirect reference.
     *  
     * @param string $direct the direct reference
     * 
>>>>>>> ca3ccc0e08db78df895196bfadefbdf8fa586ded
     * @return string the corresponding indirect reference
     */
    function addDirectReference($direct);

    /**
     * Removes a direct reference and its associated indirect reference from
     * the AccessReferenceMap.
<<<<<<< HEAD
     *
     * @param string $direct the direct reference to remove
     *
     * @return void
     *
=======
     * 
     * @param string $direct the direct reference to remove
     * 
     * @return does not return a avalue
     * 
>>>>>>> ca3ccc0e08db78df895196bfadefbdf8fa586ded
     * @throws AccessControlException
     */
    function removeDirectReference($direct);

    /**
<<<<<<< HEAD
     * Updates the access reference map with a new set of direct references,
     * maintaining any existing indirect references associated with items that
     * are in the new list. New indirect references could be generated every
     * time,  but that might mess up anything that previously used an indirect
     * reference, such as a URL parameter.
     *
     * @param string $directReferences a Set of direct references to add
     *
     * @return void
=======
     * Updates the access reference map with a new set of direct references, 
     * maintaining any existing indirect references associated with items that 
     * are in the new list. New indirect references could be generated every time, 
     * but that might mess up anything that previously used an indirect reference, 
     * such as a URL parameter. 
     * 
     * @param string $directReferences a Set of direct references to add
     * 
     * @return does not return a avalue
>>>>>>> ca3ccc0e08db78df895196bfadefbdf8fa586ded
     */
    function update($directReferences);

}
?>
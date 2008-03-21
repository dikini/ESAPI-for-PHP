<?php/**
 * OWASP Enterprise Security API (ESAPI)
 * 
 * This file is part of the Open Web Application Security Project (OWASP)
 * Enterprise Security API (ESAPI) project. For details, please see
 * http://www.owasp.org/esapi.
 *
 * Copyright (c) 2007 - The OWASP Foundation
 * 
 * The ESAPI is published by OWASP under the LGPL. You should read and accept the
 * LICENSE before you use, modify, and/or redistribute this software.
 * 
 * @author Jeff Williams <a href="http://www.aspectsecurity.com">Aspect Security</a>
 * @package org.owasp.esapi.errors;
 * @created 2007
 */


/**
 * A ValidationException should be thrown to indicate that the data provided by
 * the user or from some other external source does not match the validation
 * rules that have been specified for that data.
 * 
 * @author Jeff Williams (jeff.williams@aspectsecurity.com)
 */
class ValidationException extends EnterpriseSecurityException {

	/** The Constant serialVersionUID. */
	private static $serialVersionUID = 1;

	/**
	 * Instantiates a new validation exception.
	 */
	protected function ValidationException() {
		// hidden
	}

    /**
     * Creates a new instance of ValidationException.
     * 
     * @param message
     *            the message
     * @param cause
     * 			  the cause
     */
    public function ValidationException($userMessage, $logMessage, $cause = null ) {
        super($userMessage, $logMessage, $cause);
    }
}
?>
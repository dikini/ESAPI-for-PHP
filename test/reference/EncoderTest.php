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
 * @author Andrew van der Stock (vanderaj @ owasp.org)
 * @created 2009
 */
require_once dirname(__FILE__).'/../../src/ESAPI.php';
require_once dirname(__FILE__).'/../../src/reference/DefaultEncoder.php';
require_once dirname(__FILE__).'/../../src/codecs/MySQLCodec.php';
 
class EncoderTest extends UnitTestCase 
{
	function setUp() 
	{
		global $ESAPI;
		
		if ( !isset($ESAPI)) 
		{
			$ESAPI = new ESAPI(dirname(__FILE__).'/../testresources/ESAPI.xml');
		}
	}
	
	function tearDown()
	{
		
	}
	
function testDefaultEncoderException() {
		$this->fail();
//		
//        ArrayList list = new ArrayList();
//        list.add( new HTMLEntityCodec() );
//	    list.add( new Object() );
//	    try {
//	    	Encoder instance = new DefaultEncoder( list );
//	    	fail();
//	    }
//	    catch (IllegalArgumentException expected) {
//	    	// expected
//	    }
	}

	/**
	 * Test of canonicalize method, of class org.owasp.esapi.Encoder.
	 * 
	 * @throws EncodingException
	 */
	function testCanonicalize() {
		$this->fail();

//        ArrayList list = new ArrayList();
//        list.add( new HTMLEntityCodec() );
//	    list.add( new PercentCodec() );
//		Encoder instance = new DefaultEncoder( list );
//		
//		// Test null paths
//		assertEquals( null, instance.canonicalize(null));
//		assertEquals( null, instance.canonicalize(null, true));
//		assertEquals( null, instance.canonicalize(null, false));
//		
//		// test exception paths
//		assertEquals( "%", instance.canonicalize("%25", true));
//		assertEquals( "%", instance.canonicalize("%25", false));
//		
//        assertEquals( "%", instance.canonicalize("%25"));
//        assertEquals( "%F", instance.canonicalize("%25F"));
//        assertEquals( "<", instance.canonicalize("%3c"));
//        assertEquals( "<", instance.canonicalize("%3C"));
//        assertEquals( "%X1", instance.canonicalize("%X1"));
//
//        assertEquals( "<", instance.canonicalize("&lt"));
//        assertEquals( "<", instance.canonicalize("&LT"));
//        assertEquals( "<", instance.canonicalize("&lt;"));
//        assertEquals( "<", instance.canonicalize("&LT;"));
//        
//        assertEquals( "%", instance.canonicalize("&#37;"));
//        assertEquals( "%", instance.canonicalize("&#37"));
//        assertEquals( "%b", instance.canonicalize("&#37b"));
//
//        assertEquals( "<", instance.canonicalize("&#x3c"));
//        assertEquals( "<", instance.canonicalize("&#x3c;"));
//        assertEquals( "<", instance.canonicalize("&#x3C"));
//        assertEquals( "<", instance.canonicalize("&#X3c"));
//        assertEquals( "<", instance.canonicalize("&#X3C"));
//        assertEquals( "<", instance.canonicalize("&#X3C;"));
//
//        // percent encoding
//        assertEquals( "<", instance.canonicalize("%3c"));
//        assertEquals( "<", instance.canonicalize("%3C"));
//
//        // html entity encoding
//        assertEquals( "<", instance.canonicalize("&#60"));
//        assertEquals( "<", instance.canonicalize("&#060"));
//        assertEquals( "<", instance.canonicalize("&#0060"));
//        assertEquals( "<", instance.canonicalize("&#00060"));
//        assertEquals( "<", instance.canonicalize("&#000060"));
//        assertEquals( "<", instance.canonicalize("&#0000060"));
//        assertEquals( "<", instance.canonicalize("&#60;"));
//        assertEquals( "<", instance.canonicalize("&#060;"));
//        assertEquals( "<", instance.canonicalize("&#0060;"));
//        assertEquals( "<", instance.canonicalize("&#00060;"));
//        assertEquals( "<", instance.canonicalize("&#000060;"));
//        assertEquals( "<", instance.canonicalize("&#0000060;"));
//        assertEquals( "<", instance.canonicalize("&#x3c"));
//        assertEquals( "<", instance.canonicalize("&#x03c"));
//        assertEquals( "<", instance.canonicalize("&#x003c"));
//        assertEquals( "<", instance.canonicalize("&#x0003c"));
//        assertEquals( "<", instance.canonicalize("&#x00003c"));
//        assertEquals( "<", instance.canonicalize("&#x000003c"));
//        assertEquals( "<", instance.canonicalize("&#x3c;"));
//        assertEquals( "<", instance.canonicalize("&#x03c;"));
//        assertEquals( "<", instance.canonicalize("&#x003c;"));
//        assertEquals( "<", instance.canonicalize("&#x0003c;"));
//        assertEquals( "<", instance.canonicalize("&#x00003c;"));
//        assertEquals( "<", instance.canonicalize("&#x000003c;"));
//        assertEquals( "<", instance.canonicalize("&#X3c"));
//        assertEquals( "<", instance.canonicalize("&#X03c"));
//        assertEquals( "<", instance.canonicalize("&#X003c"));
//        assertEquals( "<", instance.canonicalize("&#X0003c"));
//        assertEquals( "<", instance.canonicalize("&#X00003c"));
//        assertEquals( "<", instance.canonicalize("&#X000003c"));
//        assertEquals( "<", instance.canonicalize("&#X3c;"));
//        assertEquals( "<", instance.canonicalize("&#X03c;"));
//        assertEquals( "<", instance.canonicalize("&#X003c;"));
//        assertEquals( "<", instance.canonicalize("&#X0003c;"));
//        assertEquals( "<", instance.canonicalize("&#X00003c;"));
//        assertEquals( "<", instance.canonicalize("&#X000003c;"));
//        assertEquals( "<", instance.canonicalize("&#x3C"));
//        assertEquals( "<", instance.canonicalize("&#x03C"));
//        assertEquals( "<", instance.canonicalize("&#x003C"));
//        assertEquals( "<", instance.canonicalize("&#x0003C"));
//        assertEquals( "<", instance.canonicalize("&#x00003C"));
//        assertEquals( "<", instance.canonicalize("&#x000003C"));
//        assertEquals( "<", instance.canonicalize("&#x3C;"));
//        assertEquals( "<", instance.canonicalize("&#x03C;"));
//        assertEquals( "<", instance.canonicalize("&#x003C;"));
//        assertEquals( "<", instance.canonicalize("&#x0003C;"));
//        assertEquals( "<", instance.canonicalize("&#x00003C;"));
//        assertEquals( "<", instance.canonicalize("&#x000003C;"));
//        assertEquals( "<", instance.canonicalize("&#X3C"));
//        assertEquals( "<", instance.canonicalize("&#X03C"));
//        assertEquals( "<", instance.canonicalize("&#X003C"));
//        assertEquals( "<", instance.canonicalize("&#X0003C"));
//        assertEquals( "<", instance.canonicalize("&#X00003C"));
//        assertEquals( "<", instance.canonicalize("&#X000003C"));
//        assertEquals( "<", instance.canonicalize("&#X3C;"));
//        assertEquals( "<", instance.canonicalize("&#X03C;"));
//        assertEquals( "<", instance.canonicalize("&#X003C;"));
//        assertEquals( "<", instance.canonicalize("&#X0003C;"));
//        assertEquals( "<", instance.canonicalize("&#X00003C;"));
//        assertEquals( "<", instance.canonicalize("&#X000003C;"));
//        assertEquals( "<", instance.canonicalize("&lt"));
//        assertEquals( "<", instance.canonicalize("&lT"));
//        assertEquals( "<", instance.canonicalize("&Lt"));
//        assertEquals( "<", instance.canonicalize("&LT"));
//        assertEquals( "<", instance.canonicalize("&lt;"));
//        assertEquals( "<", instance.canonicalize("&lT;"));
//        assertEquals( "<", instance.canonicalize("&Lt;"));
//        assertEquals( "<", instance.canonicalize("&LT;"));
//        
//        assertEquals( "<script>alert(\"hello\");</script>", instance.canonicalize("%3Cscript%3Ealert%28%22hello%22%29%3B%3C%2Fscript%3E") );
//        assertEquals( "<script>alert(\"hello\");</script>", instance.canonicalize("%3Cscript&#x3E;alert%28%22hello&#34%29%3B%3C%2Fscript%3E", false) );
//        
//        // javascript escape syntax
//        ArrayList js = new ArrayList();
//        js.add( new JavaScriptCodec() );
//        instance = new DefaultEncoder( js );
//        System.out.println( "JavaScript Decoding" );
//
//        assertEquals( "\0", instance.canonicalize("\\0"));
//        assertEquals( "\b", instance.canonicalize("\\b"));
//        assertEquals( "\t", instance.canonicalize("\\t"));
//        assertEquals( "\n", instance.canonicalize("\\n"));
//        assertEquals( ""+(char)0x0b, instance.canonicalize("\\v"));
//        assertEquals( "\f", instance.canonicalize("\\f"));
//        assertEquals( "\r", instance.canonicalize("\\r"));
//        assertEquals( "\'", instance.canonicalize("\\'"));
//        assertEquals( "\"", instance.canonicalize("\\\""));
//        assertEquals( "\\", instance.canonicalize("\\\\"));
//        assertEquals( "<", instance.canonicalize("\\<"));
//        
//        assertEquals( "<", instance.canonicalize("\\u003c"));
//        assertEquals( "<", instance.canonicalize("\\U003c"));
//        assertEquals( "<", instance.canonicalize("\\u003C"));
//        assertEquals( "<", instance.canonicalize("\\U003C"));
//        assertEquals( "<", instance.canonicalize("\\x3c"));
//        assertEquals( "<", instance.canonicalize("\\X3c"));
//        assertEquals( "<", instance.canonicalize("\\x3C"));
//        assertEquals( "<", instance.canonicalize("\\X3C"));
//
//        // css escape syntax
//        // be careful because some codecs see \0 as null byte
//        ArrayList css = new ArrayList();
//        css.add( new CSSCodec() );
//        instance = new DefaultEncoder( css );
//        System.out.println( "CSS Decoding" );
//        assertEquals( "<", instance.canonicalize("\\3c"));  // add strings to prevent null byte
//        assertEquals( "<", instance.canonicalize("\\03c"));
//        assertEquals( "<", instance.canonicalize("\\003c"));
//        assertEquals( "<", instance.canonicalize("\\0003c"));
//        assertEquals( "<", instance.canonicalize("\\00003c"));
//        assertEquals( "<", instance.canonicalize("\\3C"));
//        assertEquals( "<", instance.canonicalize("\\03C"));
//        assertEquals( "<", instance.canonicalize("\\003C"));
//        assertEquals( "<", instance.canonicalize("\\0003C"));
//        assertEquals( "<", instance.canonicalize("\\00003C"));
	}

	
    /**
     * Test of canonicalize method, of class org.owasp.esapi.Encoder.
     * 
     * @throws EncodingException
     */
    function testDoubleEncodingCanonicalization() {
$this->fail(); // DELETE ME ("doubleEncodingCanonicalization");
//        Encoder instance = ESAPI.encoder();
//
//        // note these examples use the strict=false flag on canonicalize to allow
//        // full decoding without throwing an IntrusionException. Generally, you
//        // should use strict mode as allowing double-encoding is an abomination.
//        
//        // double encoding examples
//        assertEquals( "<", instance.canonicalize("&#x26;lt&#59", false )); //double entity
//        assertEquals( "\\", instance.canonicalize("%255c", false)); //double percent
//        assertEquals( "%", instance.canonicalize("%2525", false)); //double percent
//        
//        // double encoding with multiple schemes example
//        assertEquals( "<", instance.canonicalize("%26lt%3b", false)); //first entity, then percent
//        assertEquals( "&", instance.canonicalize("&#x25;26", false)); //first percent, then entity
//          
//        // nested encoding examples
//        assertEquals( "<", instance.canonicalize("%253c", false)); //nested encode % with percent
//        assertEquals( "<", instance.canonicalize("%%33%63", false)); //nested encode both nibbles with percent
//        assertEquals( "<", instance.canonicalize("%%33c", false)); // nested encode first nibble with percent
//        assertEquals( "<", instance.canonicalize("%3%63", false));  //nested encode second nibble with percent
//        assertEquals( "<", instance.canonicalize("&&#108;t;", false)); //nested encode l with entity
//        assertEquals( "<", instance.canonicalize("%2&#x35;3c", false)); //triple percent, percent, 5 with entity
//        
//        // nested encoding with multiple schemes examples
//        assertEquals( "<", instance.canonicalize("&%6ct;", false)); // nested encode l with percent
//        assertEquals( "<", instance.canonicalize("%&#x33;c", false)); //nested encode 3 with entity            
//        
//        // multiple encoding tests
//        assertEquals( "% & <script> <script>", instance.canonicalize( "%25 %2526 %26#X3c;script&#x3e; &#37;3Cscript%25252525253e", false ) );
//        assertEquals( "< < < < < < <", instance.canonicalize( "%26lt; %26lt; &#X25;3c &#x25;3c %2526lt%253B %2526lt%253B %2526lt%253B", false ) );
//
//        // test strict mode with both mixed and multiple encoding
//        try {
//            assertEquals( "< < < < < < <", instance.canonicalize( "%26lt; %26lt; &#X25;3c &#x25;3c %2526lt%253B %2526lt%253B %2526lt%253B" ) );
//        } catch( IntrusionException e ) {
//            // expected
//        }
//        
//        try {
//            assertEquals( "<script", instance.canonicalize("%253Cscript" ) );
//        } catch( IntrusionException e ) {
//            // expected
//        }
//        try {
//            assertEquals( "<script", instance.canonicalize("&#37;3Cscript" ) );
//        } catch( IntrusionException e ) {
//            // expected
//        }
    }
	
	
	/**
	 * Test of normalize method, of class org.owasp.esapi.Validator.
	 * 
	 * @throws ValidationException
	 *             the validation exception
	 */
	function testNormalize() {
		$this->fail();
		// assertEquals( "e a i _ @ \" < > ", ESAPI.encoder().normalize("� � � _ @ \" < > \u20A0"));
	}

	
    /**
	 * Test of encodeForHTML method, of class org.owasp.esapi.Encoder.
     *
     * @throws Exception
     */
    function testEncodeForHTML() {
        $instance = ESAPI::getEncoder();
        $this->assertEqual(null, $instance->encodeForHTML(null));
        // test invalid characters are replaced with spaces
        //$this->assertEqual("a b c d e f&#x9;g", $instance->encodeForHTML("a".(chr(0))."b".(chr(4))."c".(chr(128))."d".(chr(150))."e".(chr(159))."f".(chr(9))."g"));
        	$this->assertEqual("a b c d e f&#x9;g h i j&#xa0;k&#xa1;l&#xa2;m", $instance->encodeForHTML("a".(chr(0))."b".(chr(4))."c".(chr(128))."d".(chr(150))."e".(chr(159))."f".(chr(9))."g".(chr(127))."h".(chr(129))."i".(chr(159))."j".(chr(160))."k".(chr(161))."l".(chr(162))."m"));
        $this->assertEqual("&lt;script&gt;", $instance->encodeForHTML("<script>"));
        $this->assertEqual("&amp;lt&#x3b;script&amp;gt&#x3b;", $instance->encodeForHTML("&lt;script&gt;"));
        $this->assertEqual("&#x21;&#x40;&#x24;&#x25;&#x28;&#x29;&#x3d;&#x2b;&#x7b;&#x7d;&#x5b;&#x5d;", $instance->encodeForHTML("!@$%()=+{}[]"));
//        $this->assertEqual("&#x21;&#x40;&#x24;&#x25;&#x28;&#x29;&#x3d;&#x2b;&#x7b;&#x7d;&#x5b;&#x5d;", $instance->encodeForHTML($instance->canonicalize("&#33;&#64;&#36;&#37;&#40;&#41;&#61;&#43;&#123;&#125;&#91;&#93;") ) ); //TODO: open this test up when canonicalize function is done
        $this->assertEqual(",.-_ ", $instance->encodeForHTML(",.-_ "));
        $this->assertEqual("dir&amp;", $instance->encodeForHTML("dir&"));
        $this->assertEqual("one&amp;two", $instance->encodeForHTML("one&two"));
        $this->assertEqual("".(chr(12345)).(chr(65533)).(chr(1244)), "".(chr(12345)).(chr(65533)).(chr(1244)) );
    }
    
    /**
	 * Test of encodeForHTMLAttribute method, of class org.owasp.esapi.Encoder.
	 */
    function testEncodeForHTMLAttribute() {
        $instance = ESAPI::getEncoder();
        $this->assertEqual(null, $instance->encodeForHTMLAttribute(null));
        $this->assertEqual("&lt;script&gt;", $instance->encodeForHTMLAttribute("<script>"));
        $this->assertEqual(",.-_", $instance->encodeForHTMLAttribute(",.-_"));
        $this->assertEqual("&#x20;&#x21;&#x40;&#x24;&#x25;&#x28;&#x29;&#x3d;&#x2b;&#x7b;&#x7d;&#x5b;&#x5d;", $instance->encodeForHTMLAttribute(" !@$%()=+{}[]"));
    }
    
    
    /**
     *
     */
    function testEncodeForCSS() {
$this->fail(); // DELETE ME ("encodeForCSS");
//        Encoder instance = ESAPI.encoder();
//        assertEquals(null, instance.encodeForCSS(null));
//        assertEquals("\\3c script\\3e ", instance.encodeForCSS("<script>"));
//        assertEquals("\\21 \\40 \\24 \\25 \\28 \\29 \\3d \\2b \\7b \\7d \\5b \\5d ", instance.encodeForCSS("!@$%()=+{}[]"));
    }
    

    
    /**
	 * Test of encodeForJavaScript method, of class org.owasp.esapi.Encoder.
	 */
    function testEncodeForJavascript() {
$this->fail(); // DELETE ME ("encodeForJavascript");
//        Encoder instance = ESAPI.encoder();
//        assertEquals(null, instance.encodeForJavaScript(null));
//        assertEquals("\\x3Cscript\\x3E", instance.encodeForJavaScript("<script>"));
//        assertEquals(",.\\x2D_\\x20", instance.encodeForJavaScript(",.-_ "));
//        assertEquals("\\x21\\x40\\x24\\x25\\x28\\x29\\x3D\\x2B\\x7B\\x7D\\x5B\\x5D", instance.encodeForJavaScript("!@$%()=+{}[]"));
        // assertEquals( "\\0", instance.encodeForJavaScript("\0"));
        // assertEquals( "\\b", instance.encodeForJavaScript("\b"));
        // assertEquals( "\\t", instance.encodeForJavaScript("\t"));
        // assertEquals( "\\n", instance.encodeForJavaScript("\n"));
        // assertEquals( "\\v", instance.encodeForJavaScript("" + (char)0x0b));
        // assertEquals( "\\f", instance.encodeForJavaScript("\f"));
        // assertEquals( "\\r", instance.encodeForJavaScript("\r"));
        // assertEquals( "\\'", instance.encodeForJavaScript("\'"));
        // assertEquals( "\\\"", instance.encodeForJavaScript("\""));
        // assertEquals( "\\\\", instance.encodeForJavaScript("\\"));
    }
        
    /**
     *
     */
    function testEncodeForVBScript() {
$this->fail(); // DELETE ME ("encodeForVBScript");        
//        Encoder instance = ESAPI.encoder();
//        assertEquals(null, instance.encodeForVBScript(null));
//        assertEquals( "chrw(60)&\"script\"&chrw(62)", instance.encodeForVBScript("<script>"));
//        assertEquals( "x\"&chrw(32)&chrw(33)&chrw(64)&chrw(36)&chrw(37)&chrw(40)&chrw(41)&chrw(61)&chrw(43)&chrw(123)&chrw(125)&chrw(91)&chrw(93)", instance.encodeForVBScript("x !@$%()=+{}[]"));
//        assertEquals( "alert\"&chrw(40)&chrw(39)&\"ESAPI\"&chrw(32)&\"test\"&chrw(33)&chrw(39)&chrw(41)", instance.encodeForVBScript("alert('ESAPI test!')" ));
//        assertEquals( "jeff.williams\"&chrw(64)&\"aspectsecurity.com", instance.encodeForVBScript("jeff.williams@aspectsecurity.com"));
//        assertEquals( "test\"&chrw(32)&chrw(60)&chrw(62)&chrw(32)&\"test", instance.encodeForVBScript("test <> test" ));
    }

        
    /**
	 * Test of encodeForXPath method, of class org.owasp.esapi.Encoder.
	 */
    function testEncodeForXPath() {
$this->fail(); // DELETE ME ("encodeForXPath");
//        Encoder instance = ESAPI.encoder();
//        assertEquals(null, instance.encodeForXPath(null));
//        assertEquals("&#x27;or 1&#x3d;1", instance.encodeForXPath("'or 1=1"));
    }
    

    
    /**
	 * Test of encodeForSQL method, of class org.owasp.esapi.Encoder.
	 */
    function testEncodeForSQL() {
        $instance = ESAPI::getEncoder();
        
        $mysqlAnsiCodec = new MySQLCodec(MySQLCodec::MYSQL_ANSI);
		$mysqlStdCodec = new MySQLCodec(MySQLCodec::MYSQL_STD);
        
        $this->assertEqual(null, $instance->encodeForSQL($mysqlAnsiCodec, null));
        $this->assertEqual("Jeff'' or ''1''=''1", $instance->encodeForSQL($mysqlAnsiCodec, "Jeff' or '1'='1"));
                
        $this->assertEqual(null, $instance->encodeForSQL($mysqlStdCodec, null));
        $this->assertEqual("Jeff\\' or \\'1\\'\\=\\'1", $instance->encodeForSQL($mysqlStdCodec, "Jeff' or '1'='1"));
		$this->assertEqual( "\\b \\n \\r \\t \\z \\_ \\\" \\' \\\\ \\0 \\%", $instance->encodeForSQL($mysqlStdCodec, "\x08 \x0a \x0d \x09 \x1a _ \" ' \\ \x00 \x25") );
		
		$this->fail(); //DELETE ME 
        //Codec oracle = new OracleCodec();
        //assertEquals("Oracle", null, instance.encodeForSQL(oracle, null));
        //assertEquals("Oracle", "Jeff\\' or \\'1\\'\\=\\'1", instance.encodeForSQL(oracle, "Jeff' or '1'='1"));
    }

    
    /**
	 * Test of encodeForLDAP method, of class org.owasp.esapi.Encoder.
	 */
    function testEncodeForLDAP() {
$this->fail(); // DELETE ME ("encodeForLDAP");
//        Encoder instance = ESAPI.encoder();
//        assertEquals(null, instance.encodeForLDAP(null));
//        assertEquals("No special characters to escape", "Hi This is a test #��", instance.encodeForLDAP("Hi This is a test #��"));
//        assertEquals("Zeros", "Hi \\00", instance.encodeForLDAP("Hi \u0000"));
//        assertEquals("LDAP Christams Tree", "Hi \\28This\\29 = is \\2a a \\5c test # � � �", instance.encodeForLDAP("Hi (This) = is * a \\ test # � � �"));
    }
    
    /**
	 * Test of encodeForLDAP method, of class org.owasp.esapi.Encoder.
	 */
    function testEncodeForDN() {
$this->fail(); // DELETE ME ("encodeForDN");
//        Encoder instance = ESAPI.encoder();
//        assertEquals(null, instance.encodeForDN(null));
//        assertEquals("No special characters to escape", "Hello�", instance.encodeForDN("Hello�"));
//        assertEquals("leading #", "\\# Hello�", instance.encodeForDN("# Hello�"));
//        assertEquals("leading space", "\\ Hello�", instance.encodeForDN(" Hello�"));
//        assertEquals("trailing space", "Hello�\\ ", instance.encodeForDN("Hello� "));
//        assertEquals("less than greater than", "Hello\\<\\>", instance.encodeForDN("Hello<>"));
//        assertEquals("only 3 spaces", "\\  \\ ", instance.encodeForDN("   "));
//        assertEquals("Christmas Tree DN", "\\ Hello\\\\ \\+ \\, \\\"World\\\" \\;\\ ", instance.encodeForDN(" Hello\\ + , \"World\" ; "));
    }
    

    /**
	 * Test of encodeForXML method, of class org.owasp.esapi.Encoder.
	 */
    function testEncodeForXML() {
$this->fail(); // DELETE ME ("encodeForXML");
//        Encoder instance = ESAPI.encoder();
//        assertEquals(null, instance.encodeForXML(null));
//        assertEquals(" ", instance.encodeForXML(" "));
//        assertEquals("&lt;script&gt;", instance.encodeForXML("<script>"));
//        assertEquals(",.-_", instance.encodeForXML(",.-_"));
//        assertEquals("&#x21;&#x40;&#x24;&#x25;&#x28;&#x29;&#x3d;&#x2b;&#x7b;&#x7d;&#x5b;&#x5d;", instance.encodeForXML("!@$%()=+{}[]"));
    }
    
    
    
    /**
	 * Test of encodeForXMLAttribute method, of class org.owasp.esapi.Encoder.
	 */
    function testEncodeForXMLAttribute() {
$this->fail(); // DELETE ME ("encodeForXMLAttribute");
//        Encoder instance = ESAPI.encoder();
//        assertEquals(null, instance.encodeForXMLAttribute(null));
//        assertEquals("&#x20;", instance.encodeForXMLAttribute(" "));
//        assertEquals("&lt;script&gt;", instance.encodeForXMLAttribute("<script>"));
//        assertEquals(",.-_", instance.encodeForXMLAttribute(",.-_"));
//        assertEquals("&#x20;&#x21;&#x40;&#x24;&#x25;&#x28;&#x29;&#x3d;&#x2b;&#x7b;&#x7d;&#x5b;&#x5d;", instance.encodeForXMLAttribute(" !@$%()=+{}[]"));
    }
    
    /**
	 * Test of encodeForURL method, of class org.owasp.esapi.Encoder.
     *
     * @throws Exception
     */
    function testEncodeForURL() {
$this->fail(); // DELETE ME ("encodeForURL");
//        Encoder instance = ESAPI.encoder();
//        assertEquals(null, instance.encodeForURL(null));
//        assertEquals("%3Cscript%3E", instance.encodeForURL("<script>"));
    }
    
    /**
	 * Test of decodeFromURL method, of class org.owasp.esapi.Encoder.
     *
     * @throws Exception
     */
    function testDecodeFromURL() {
$this->fail(); // DELETE ME ("decodeFromURL");
//        Encoder instance = ESAPI.encoder();
//        try {
//        	assertEquals(null, instance.decodeFromURL(null));
//            assertEquals("<script>", instance.decodeFromURL("%3Cscript%3E"));
//            assertEquals("     ", instance.decodeFromURL("+++++") );
//        } catch ( Exception e ) {
//            fail();
//        }
    }
    
    /**
	 * Test of encodeForBase64 method, of class org.owasp.esapi.Encoder.
	 */
    function testEncodeForBase64() {
$this->fail(); // DELETE ME ("encodeForBase64");
//        Encoder instance = ESAPI.encoder();
//        
//        try {
//        	assertEquals(null, instance.encodeForBase64(null, false));
//            assertEquals(null, instance.encodeForBase64(null, true));
//            assertEquals(null, instance.decodeFromBase64(null));
//            for ( int i=0; i < 100; i++ ) {
//                byte[] r = ESAPI.randomizer().getRandomString( 20, DefaultEncoder.CHAR_SPECIALS ).getBytes();
//                String encoded = instance.encodeForBase64( r, ESAPI.randomizer().getRandomBoolean() );
//                byte[] decoded = instance.decodeFromBase64( encoded );
//                assertTrue( Arrays.equals( r, decoded ) );
//            }
//        } catch ( IOException e ) {
//            fail();
//        }
    }
    
    /**
	 * Test of decodeFromBase64 method, of class org.owasp.esapi.Encoder.
	 */
    function testDecodeFromBase64() {
$this->fail(); // DELETE ME ("decodeFromBase64");
//        Encoder instance = ESAPI.encoder();
//        for ( int i=0; i < 100; i++ ) {
//            try {
//                byte[] r = ESAPI.randomizer().getRandomString( 20, DefaultEncoder.CHAR_SPECIALS ).getBytes();
//                String encoded = instance.encodeForBase64( r, ESAPI.randomizer().getRandomBoolean() );
//                byte[] decoded = instance.decodeFromBase64( encoded );
//                assertTrue( Arrays.equals( r, decoded ) );
//            } catch ( IOException e ) {
//                fail();
//	        }
//        }
//        for ( int i=0; i < 100; i++ ) {
//            try {
//                byte[] r = ESAPI.randomizer().getRandomString( 20, DefaultEncoder.CHAR_SPECIALS ).getBytes();
//                String encoded = ESAPI.randomizer().getRandomString(1, DefaultEncoder.CHAR_ALPHANUMERICS) + instance.encodeForBase64( r, ESAPI.randomizer().getRandomBoolean() );
//	            byte[] decoded = instance.decodeFromBase64( encoded );
//	            assertFalse( Arrays.equals(r, decoded) );
//            } catch ( IOException e ) {
//            	// expected
//            }
//        }
    }
    

    /**
	 * Test of WindowsCodec
	 */
    function testWindowsCodec() {
$this->fail(); // DELETE ME ("WindowsCodec");
//        Encoder instance = ESAPI.encoder();
//
//        Codec win = new WindowsCodec();
//        char[] immune = new char[0];
//        assertEquals(null, instance.encodeForOS(win, null));
//        
//        PushbackString npbs = new PushbackString("n");
//        assertEquals(null, win.decodeCharacter(npbs));
//
//        PushbackString epbs = new PushbackString("");
//        assertEquals(null, win.decodeCharacter(epbs));
//        
//        Character c = new Character('<');
//        PushbackString cpbs = new PushbackString(win.encodeCharacter(immune, c));
//        Character decoded = win.decodeCharacter(cpbs);
//        assertEquals(c, decoded);
//        
//        String orig = "c:\\jeff";
//        String enc = win.encode(DefaultEncoder.CHAR_ALPHANUMERICS, orig);
//        assertEquals(orig, win.decode(enc));
//        assertEquals(orig, win.decode(orig));
//        
//     // TODO: Check that these are acceptable for Windows
//        assertEquals("c^:^\\jeff", instance.encodeForOS(win, "c:\\jeff"));		
//        assertEquals("c^:^\\jeff", win.encode(immune, "c:\\jeff"));
//        assertEquals("dir^ ^&^ foo", instance.encodeForOS(win, "dir & foo"));
//        assertEquals("dir^ ^&^ foo", win.encode(immune, "dir & foo"));
    }

    /**
	 * Test of UnixCodec
	 */
    function testUnixCodec() {
$this->fail(); // DELETE ME ("UnixCodec");
//        Encoder instance = ESAPI.encoder();
//
//        Codec unix = new UnixCodec();
//        char[] immune = new char[0];
//        assertEquals(null, instance.encodeForOS(unix, null));
//        
//        PushbackString npbs = new PushbackString("n");
//        assertEquals(null, unix.decodeCharacter(npbs));
//
//        Character c = new Character('<');
//        PushbackString cpbs = new PushbackString(unix.encodeCharacter(immune, c));
//        Character decoded = unix.decodeCharacter(cpbs);
//        assertEquals(c, decoded);
//        
//        PushbackString epbs = new PushbackString("");
//        assertEquals(null, unix.decodeCharacter(epbs));
//
//        String orig = "/etc/passwd";
//        String enc = unix.encode(immune, orig);
//        assertEquals(orig, unix.decode(enc));
//        assertEquals(orig, unix.decode(orig));
//        
//     // TODO: Check that these are acceptable for Unix hosts
//        assertEquals("c\\:\\\\jeff", instance.encodeForOS(unix, "c:\\jeff"));
//        assertEquals("c\\:\\\\jeff", unix.encode(immune, "c:\\jeff"));
//        assertEquals("dir\\ \\&\\ foo", instance.encodeForOS(unix, "dir & foo"));
//        assertEquals("dir\\ \\&\\ foo", unix.encode(immune, "dir & foo"));
//
//        // Unix paths (that must be encoded safely)
//        // TODO: Check that these are acceptable for Unix
//        assertEquals("\\/etc\\/hosts", instance.encodeForOS(unix, "/etc/hosts"));
//        assertEquals("\\/etc\\/hosts\\;\\ ls\\ -l", instance.encodeForOS(unix, "/etc/hosts; ls -l"));
    }
}
?>
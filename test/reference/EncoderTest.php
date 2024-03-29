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


/**
 * 
 */
require_once dirname(__FILE__).'/../../src/ESAPI.php';
require_once dirname(__FILE__).'/../../src/reference/DefaultEncoder.php';
require_once dirname(__FILE__).'/../../src/codecs/MySQLCodec.php';
require_once dirname(__FILE__).'/../../src/codecs/OracleCodec.php';
require_once dirname(__FILE__).'/../../src/codecs/UnixCodec.php';
require_once dirname(__FILE__).'/../../src/codecs/WindowsCodec.php';


/**
 * Tests of DefaultEncoder methods.
 * 
 * @author jah (at jaboite.co.uk)
 * @since  1.6
 */
class EncoderTest extends PHPUnit_Framework_TestCase
{
    private $encoderInstance = null;

    function setUp()
    {
        global $ESAPI;

        if ( !isset($ESAPI))
        {
            $ESAPI = new ESAPI(dirname(__FILE__).'/../testresources/ESAPI.xml');
        }
        
		$codecArray = array();
        array_push( $codecArray, new HTMLEntityCodec() );
        array_push( $codecArray, new PercentCodec() );
        $this->encoderInstance = new DefaultEncoder( $codecArray );
    }

    function tearDown()
    {
        // NoOp
    }


    /*
     * Test for exception thrown when DefaultEncoder is constructed with an array
     * containing an object other than a Codec instance.
     */
    function testDefaultEncoderException() {
        $codecList = array();
        array_push( $codecList, new HTMLEntityCodec() );
        array_push( $codecList, new Exception() ); // any class except a codec will suffice.

        $this->setExpectedException('Exception');
        $instance = new DefaultEncoder( $codecList );
    }


    /*
     * Test of canonicalize method of class Encoder.
     *
     * @throws EncodingException
     */
    function testCanonicalize_001() {
        // This block sets-up the encoder for subsequent canonicalize tests
        $codecArray = array();
        array_push( $codecArray, new HTMLEntityCodec() );
        array_push( $codecArray, new PercentCodec() );
        $this->encoderInstance = new DefaultEncoder( $codecArray );

        $this->assertEquals( null, $this->encoderInstance->canonicalize(null));
    }
    function testCanonicalize_002() {
        $this->assertEquals( null, $this->encoderInstance->canonicalize(null, true));
    }
    function testCanonicalize_003() {
        $this->assertEquals( null, $this->encoderInstance->canonicalize(null, false));
    }

    function testCanonicalize_004() {
        $this->assertEquals( "%", $this->encoderInstance->canonicalize("%25", true));
    }
    function testCanonicalize_005() {
        $this->assertEquals( "%", $this->encoderInstance->canonicalize("%25", false));
    }

    function testCanonicalize_006() {
        $this->assertEquals( "%", $this->encoderInstance->canonicalize("%25"));
    }
    function testCanonicalize_007() {
        $this->assertEquals( "%F", $this->encoderInstance->canonicalize("%25F"));
    }
    function testCanonicalize_008() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("%3c"));
    }
    function testCanonicalize_009() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("%3C"));
    }
    function testCanonicalize_010() {
        $this->assertEquals( "%X1", $this->encoderInstance->canonicalize("%X1"));
    }

    function testCanonicalize_011() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&lt"));
    }
    function testCanonicalize_012() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&LT"));
    }
    function testCanonicalize_013() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&lt;"));
    }
    function testCanonicalize_014() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&LT;"));
    }

    function testCanonicalize_015() {
        $this->assertEquals( "%", $this->encoderInstance->canonicalize("&#37;"));
    }
    function testCanonicalize_016() {
        $this->assertEquals( "%", $this->encoderInstance->canonicalize("&#37"));
    }
    function testCanonicalize_017() {
        $this->assertEquals( "%b", $this->encoderInstance->canonicalize("&#37b"));
    }
    function testCanonicalize_018() {
        $this->assertEquals( "%b", $this->encoderInstance->canonicalize("&#37;b"));
    }
    function testCanonicalize_019() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x3c"));
    }
    function testCanonicalize_020() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x3c;"));
    }
    function testCanonicalize_021() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x3C"));
    }
    function testCanonicalize_022() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X3c"));
    }
    function testCanonicalize_023() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X3C"));
    }
    function testCanonicalize_024() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X3C;"));
    }

    // percent encoding
    function testCanonicalize_025() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("%3c"));
    }
    function testCanonicalize_026() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("%3C"));
    }

    // html entity encoding
    function testCanonicalize_027() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#60"));
    }
    function testCanonicalize_028() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#060"));
    }
    function testCanonicalize_029() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#0060"));
    }
    function testCanonicalize_030() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#00060"));
    }
    function testCanonicalize_031() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#000060"));
    }
    function testCanonicalize_032() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#0000060"));
    }
    function testCanonicalize_033() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#60;"));
    }
    function testCanonicalize_034() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#060;"));
    }
    function testCanonicalize_035() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#0060;"));
    }
    function testCanonicalize_036() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#00060;"));
    }
    function testCanonicalize_037() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#000060;"));
    }
    function testCanonicalize_038() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#0000060;"));
    }
    function testCanonicalize_039() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x3c"));
    }
    function testCanonicalize_040() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x03c"));
    }
    function testCanonicalize_041() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x003c"));
    }
    function testCanonicalize_042() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x0003c"));
    }
    function testCanonicalize_043() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x00003c"));
    }
    function testCanonicalize_044() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x000003c"));
    }
    function testCanonicalize_045() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x3c;"));
    }
    function testCanonicalize_046() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x03c;"));
    }
    function testCanonicalize_047() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x003c;"));
    }
    function testCanonicalize_048() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x0003c;"));
    }
    function testCanonicalize_049() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x00003c;"));
    }
    function testCanonicalize_050() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x000003c;"));
    }
    function testCanonicalize_051() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X3c"));
    }
    function testCanonicalize_052() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X03c"));
    }
    function testCanonicalize_053() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X003c"));
    }
    function testCanonicalize_054() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X0003c"));
    }
    function testCanonicalize_055() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X00003c"));
    }
    function testCanonicalize_056() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X000003c"));
    }
    function testCanonicalize_057() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X3c;"));
    }
    function testCanonicalize_058() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X03c;"));
    }
    function testCanonicalize_059() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X003c;"));
    }
    function testCanonicalize_060() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X0003c;"));
    }
    function testCanonicalize_061() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X00003c;"));
    }
    function testCanonicalize_062() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X000003c;"));
    }
    function testCanonicalize_063() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x3C"));
    }
    function testCanonicalize_064() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x03C"));
    }
    function testCanonicalize_065() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x003C"));
    }
    function testCanonicalize_066() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x0003C"));
    }
    function testCanonicalize_067() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x00003C"));
    }
    function testCanonicalize_068() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x000003C"));
    }
    function testCanonicalize_069() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x3C;"));
    }
    function testCanonicalize_070() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x03C;"));
    }
    function testCanonicalize_071() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x003C;"));
    }
    function testCanonicalize_072() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x0003C;"));
    }
    function testCanonicalize_073() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x00003C;"));
    }
    function testCanonicalize_074() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x000003C;"));
    }
    function testCanonicalize_075() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X3C"));
    }
    function testCanonicalize_076() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X03C"));
    }
    function testCanonicalize_077() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X003C"));
    }
    function testCanonicalize_078() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X0003C"));
    }
    function testCanonicalize_079() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X00003C"));
    }
    function testCanonicalize_080() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X000003C"));
    }
    function testCanonicalize_081() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X3C;"));
    }
    function testCanonicalize_082() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X03C;"));
    }
    function testCanonicalize_083() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X003C;"));
    }
    function testCanonicalize_084() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X0003C;"));
    }
    function testCanonicalize_085() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X00003C;"));
    }
    function testCanonicalize_086() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#X000003C;"));
    }

    function testCanonicalize_087() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&lt"));
    }
    function testCanonicalize_088() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&lT"));
    }
    function testCanonicalize_089() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&Lt"));
    }
    function testCanonicalize_090() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&LT"));
    }
    function testCanonicalize_091() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&lt;"));
    }
    function testCanonicalize_092() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&lT;"));
    }
    function testCanonicalize_093() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&Lt;"));
    }
    function testCanonicalize_094() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&LT;"));
    }

    function testCanonicalize_095() {
        $this->assertEquals( "<script>alert(\"hello\");</script>",
            $this->encoderInstance->canonicalize("%3Cscript%3Ealert%28%22hello%22%29%3B%3C%2Fscript%3E") );
    }
    function testCanonicalize_096() {
        $this->assertEquals( "<script>alert(\"hello\");</script>",
            $this->encoderInstance->canonicalize("%3Cscript&#x3E;alert%28%22hello&#34%29%3B%3C%2Fscript%3E", false) );
    }

    // javascript escape syntax
    function testCanonicalize_097() {
        $this->encoderInstance = null;
        $this->encoderInstance = new DefaultEncoder( array(new JavaScriptCodec()) );

        $this->assertEquals( "\0", $this->encoderInstance->canonicalize("\\0"));
    }
    function testCanonicalize_098() {
        $this->assertEquals( "".chr(0x08), $this->encoderInstance->canonicalize("\\b"));
    }
    function testCanonicalize_099() {
        $this->assertEquals( "\t", $this->encoderInstance->canonicalize("\\t"));
    }
    function testCanonicalize_100() {
        $this->assertEquals( "\n", $this->encoderInstance->canonicalize("\\n"));
    }
    function testCanonicalize_101() {
        $this->assertEquals( "".chr(0x0b), $this->encoderInstance->canonicalize("\\v"));
    }
    function testCanonicalize_102() {
        $this->assertEquals( "".chr(0x0c), $this->encoderInstance->canonicalize("\\f"));
    }
    function testCanonicalize_103() {
        $this->assertEquals( "\r", $this->encoderInstance->canonicalize("\\r"));
    }
    function testCanonicalize_104() {
        $this->assertEquals( "'", $this->encoderInstance->canonicalize("\\'"));
    }
    function testCanonicalize_105() {
        $this->assertEquals( "\"", $this->encoderInstance->canonicalize("\\\""));
    }
    function testCanonicalize_106() {
        $this->assertEquals( "\\", $this->encoderInstance->canonicalize("\\\\"));
    }
    function testCanonicalize_107() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\<"));
    }
    function testCanonicalize_108() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\u003c"));
    }
    function testCanonicalize_109() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\U003c"));
    }
    function testCanonicalize_110() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\u003C"));
    }
    function testCanonicalize_111() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\U003C"));
    }
    function testCanonicalize_112() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\x3c"));
    }
    function testCanonicalize_113() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\X3c"));
    }
    function testCanonicalize_114() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\x3C"));
    }
    function testCanonicalize_115() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\X3C"));
    }

    // css escape syntax
    function testCanonicalize_116() {
        $this->encoderInstance = null;
        $this->encoderInstance = new DefaultEncoder( array(new CSSCodec()) );

        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\3c"));
    }
    function testCanonicalize_117() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\03c"));
    }
    function testCanonicalize_118() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\003c"));
    }
    function testCanonicalize_119() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\0003c"));
    }
    function testCanonicalize_120() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\00003c"));
    }
    function testCanonicalize_121() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\3C"));
    }
    function testCanonicalize_122() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\03C"));
    }
    function testCanonicalize_123() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\003C"));
    }
    function testCanonicalize_124() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\0003C"));
    }
    function testCanonicalize_125() {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("\\00003C"));
    }


    // note these examples use the strict=false flag on canonicalize to allow
    // full decoding without throwing an IntrusionException. Generally, you
    // should use strict mode as allowing double-encoding is an abomination.

    // double encoding examples
    function testDoubleEncodingCanonicalization_01()
    {
        $this->encoderInstance = ESAPI::getEncoder();

        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&#x26;lt&#59", false )); //double entity
    }
    function testDoubleEncodingCanonicalization_02()
    {
        $this->assertEquals( "\\", $this->encoderInstance->canonicalize("%255c", false)); //double percent
    }
    function testDoubleEncodingCanonicalization_03()
    {
        $this->assertEquals( "%", $this->encoderInstance->canonicalize("%2525", false)); //double percent
    }

    // double encoding with multiple schemes example
    function testDoubleEncodingCanonicalization_04()
    {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("%26lt%3b", false)); //first entity, then percent
    }
    function testDoubleEncodingCanonicalization_05()
    {
        $this->assertEquals( "&", $this->encoderInstance->canonicalize("&#x25;26", false)); //first percent, then entity
    }

    // nested encoding examples
    function testDoubleEncodingCanonicalization_06()
    {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("%253c", false)); //nested encode % with percent
    }
    function testDoubleEncodingCanonicalization_07()
    {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("%%33%63", false)); //nested encode both nibbles with percent
    }
    function testDoubleEncodingCanonicalization_08()
    {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("%%33c", false)); // nested encode first nibble with percent
    }
    function testDoubleEncodingCanonicalization_09()
    {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("%3%63", false));  //nested encode second nibble with percent
    }
    function testDoubleEncodingCanonicalization_10()
    {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&&#108;t;", false)); //nested encode l with entity
    }
    function testDoubleEncodingCanonicalization_11()
    {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("%2&#x35;3c", false)); //triple percent, percent, 5 with entity
    }

    // nested encoding with multiple schemes examples
    function testDoubleEncodingCanonicalization_12()
    {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("&%6ct;", false)); // nested encode l with percent
    }
    function testDoubleEncodingCanonicalization_13()
    {
        $this->assertEquals( "<", $this->encoderInstance->canonicalize("%&#x33;c", false)); //nested encode 3 with entity

    }

    // multiple encoding tests
    function testDoubleEncodingCanonicalization_14()
    {
        $this->assertEquals( "% & <script> <script>", $this->encoderInstance->canonicalize( "%25 %2526 %26#X3c;script&#x3e; &#37;3Cscript%25252525253e", false ) );
    }
    function testDoubleEncodingCanonicalization_15()
    {
        $this->assertEquals( "< < < < < < <", $this->encoderInstance->canonicalize( "%26lt; %26lt; &#X25;3c &#x25;3c %2526lt%253B %2526lt%253B %2526lt%253B", false ) );

    }

    // test strict mode with both mixed and multiple encoding
    function testDoubleEncodingCanonicalization_16()
    {
        $this->setExpectedException('IntrusionException');
        $this->encoderInstance->canonicalize('%26lt; %26lt; &#X25;3c &#x25;3c %2526lt%253B %2526lt%253B %2526lt%253B');
    }
    function testDoubleEncodingCanonicalization_17()
    {

        $this->setExpectedException('IntrusionException');
        $this->encoderInstance->canonicalize('%253Cscript');
    }
    function testDoubleEncodingCanonicalization_18()
    {
        $this->setExpectedException('IntrusionException');
        $this->encoderInstance->canonicalize('&#37;3Cscript');
    }


    /*
     * Test of encodeForHTML method of class Encoder.
     *
     * @throws Exception
     */
    function testEncodeForHTML_01() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->encodeForHTML(null));
    }
    function testEncodeForHTML_02() {
        $instance = ESAPI::getEncoder();
        // test invalid characters are replaced with spaces
        $this->assertEquals("a b c d e f&#x9;g", $instance->encodeForHTML("a".(chr(0))."b".(chr(4))."c".(chr(128))."d".(chr(150))."e".(chr(159))."f".(chr(9))."g"));
    }
    function testEncodeForHTML_03() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("a b c d e f&#x9;g h i j&nbsp;k&iexcl;l&cent;m", $instance->encodeForHTML("a".(chr(0))."b".(chr(4))."c".(chr(128))."d".(chr(150))."e".(chr(159))."f".(chr(9))."g".(chr(127))."h".(chr(129))."i".(chr(159))."j".(chr(160))."k".(chr(161))."l".(chr(162))."m"));
    }
    function testEncodeForHTML_04() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("&lt;script&gt;", $instance->encodeForHTML("<script>"));
    }
    function testEncodeForHTML_05() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("&amp;lt&#x3b;script&amp;gt&#x3b;", $instance->encodeForHTML("&lt;script&gt;"));
    }
    function testEncodeForHTML_06() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("&#x21;&#x40;&#x24;&#x25;&#x28;&#x29;&#x3d;&#x2b;&#x7b;&#x7d;&#x5b;&#x5d;", $instance->encodeForHTML("!@$%()=+{}[]"));
    }
    function testEncodeForHTML_07() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("&#x21;&#x40;&#x24;&#x25;&#x28;&#x29;&#x3d;&#x2b;&#x7b;&#x7d;&#x5b;&#x5d;", $instance->encodeForHTML($instance->canonicalize("&#33;&#64;&#36;&#37;&#40;&#41;&#61;&#43;&#123;&#125;&#91;&#93;", false)));
    }
    function testEncodeForHTML_08() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(",.-_ ", $instance->encodeForHTML(",.-_ "));
    }
    function testEncodeForHTML_09() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("dir&amp;", $instance->encodeForHTML("dir&"));
    }
    function testEncodeForHTML_10() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("one&amp;two", $instance->encodeForHTML("one&two"));
    }
    function testEncodeForHTML_11() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("".(chr(12345)).(chr(65533)).(chr(1244)), "".(chr(12345)).(chr(65533)).(chr(1244)) );
    }


    /*
     * Test of encodeForHTMLAttribute method of class Encoder.
     */
    function testEncodeForHTMLAttribute_01() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->encodeForHTMLAttribute(null));
    }
    function testEncodeForHTMLAttribute_02() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("&lt;script&gt;", $instance->encodeForHTMLAttribute("<script>"));
    }
    function testEncodeForHTMLAttribute_03() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(",.-_", $instance->encodeForHTMLAttribute(",.-_"));
    }
    function testEncodeForHTMLAttribute_04() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("&#x20;&#x21;&#x40;&#x24;&#x25;&#x28;&#x29;&#x3d;&#x2b;&#x7b;&#x7d;&#x5b;&#x5d;", $instance->encodeForHTMLAttribute(" !@$%()=+{}[]"));
    }


    /*
     * Test of encodeForCSS method of class Encoder.
     */
    function testEncodeForCSS_01() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->encodeForCSS(null));
    }
    function testEncodeForCSS_02() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("\\3c script\\3e ", $instance->encodeForCSS("<script>"));
    }
    function testEncodeForCSS_03() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("\\21 \\40 \\24 \\25 \\28 \\29 \\3d \\2b \\7b \\7d \\5b \\5d ", $instance->encodeForCSS("!@$%()=+{}[]"));
    }


    /*
     * Test of encodeForJavaScript method of class Encoder.
     * Note that JavaScriptCodec is closer to ESAPI 2 for Java and so these
     * tests are taken from that version.
     */
    function testEncodeForJavascript_01() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->encodeForJavaScript(null));
    }
    function testEncodeForJavascript_02() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("\\x3Cscript\\x3E", $instance->encodeForJavaScript("<script>"));
    }
    function testEncodeForJavascript_03() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(",.\\x2D_\\x20", $instance->encodeForJavaScript(",.-_ "));
    }
    function testEncodeForJavascript_04() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("\\x21\\x40\\x24\\x25\\x28\\x29\\x3D\\x2B\\x7B\\x7D\\x5B\\x5D", $instance->encodeForJavaScript("!@$%()=+{}[]"));
    }
    function testEncodeForJavascript_05() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals( "\\x00", $instance->encodeForJavaScript("\0"));
    }
    function testEncodeForJavascript_06() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals( "\\x5C", $instance->encodeForJavaScript("\\"));
    }


    /*
     * Test of encodeForVBScript method of class Encoder.
     */
    function testEncodeForVBScript_01() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->encodeForVBScript(null));
    }
    function testEncodeForVBScript_02() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals('""', $instance->encodeForVBScript('"'));
    }
    function testEncodeForVBScript_03() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals('"<script">', $instance->encodeForVBScript('<script>'));
    }
    function testEncodeForVBScript_04() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(' "!"@"$"%"(")"="+"{"}"["]""', $instance->encodeForVBScript(' !@$%()=+{}[]"'));
    }


    /*
     * Test of encodeForXPath method of class Encoder.
     */
    function testEncodeForXPath_01() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->encodeForXPath(null));
    }
    function testEncodeForXPath_02() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("&#x27;or 1&#x3d;1", $instance->encodeForXPath("'or 1=1"));
    }


    /*
     * Test of encodeForSQL method of class Encoder.
     */
    function testEncodeForSQL_MySQL_ANSI_01() {
        $instance = ESAPI::getEncoder();
        $mysqlAnsiCodec = new MySQLCodec(MySQLCodec::MYSQL_ANSI);
        $this->assertEquals(null, $instance->encodeForSQL($mysqlAnsiCodec, null));
    }
    function testEncodeForSQL_MySQL_ANSI_02() {
        $instance = ESAPI::getEncoder();
        $mysqlAnsiCodec = new MySQLCodec(MySQLCodec::MYSQL_ANSI);
        $this->assertEquals("Jeff'' or ''1''=''1", $instance->encodeForSQL($mysqlAnsiCodec, "Jeff' or '1'='1"));
    }
    function testEncodeForSQL_MySQL_STD_01() {
        $instance = ESAPI::getEncoder();
        $mysqlStdCodec = new MySQLCodec(MySQLCodec::MYSQL_STD);
        $this->assertEquals(null, $instance->encodeForSQL($mysqlStdCodec, null));
    }
    function testEncodeForSQL_MySQL_STD_02() {
        $instance = ESAPI::getEncoder();
        $mysqlStdCodec = new MySQLCodec(MySQLCodec::MYSQL_STD);
        $this->assertEquals("Jeff\\' or \\'1\\'\\=\\'1", $instance->encodeForSQL($mysqlStdCodec, "Jeff' or '1'='1"));
    }
    function testEncodeForSQL_MySQL_STD_03() {
        $instance = ESAPI::getEncoder();
        $mysqlStdCodec = new MySQLCodec(MySQLCodec::MYSQL_STD);
        $this->assertEquals( "\\b \\n \\r \\t \\Z \\_ \\\" \\' \\\\ \\0 \\%", $instance->encodeForSQL($mysqlStdCodec, "\x08 \x0a \x0d \x09 \x1a _ \" ' \\ \x00 \x25") );
    }
    function testEncodeForSQL_Oracle01() {
        $instance = ESAPI::getEncoder();
        $oracleCodec = new OracleCodec();
        $this->assertEquals(null, $instance->encodeForSQL($oracleCodec, null));
    }
    function testEncodeForSQL_Oracle02() {
        $instance = ESAPI::getEncoder();
        $oracleCodec = new OracleCodec();
        $this->assertEquals("Jeff'' or ''1''=''1", $instance->encodeForSQL($oracleCodec, "Jeff' or '1'='1"));
    }


    /*
     * Test of encodeForLDAP method of class Encoder.
     */
    function testEncodeForLDAP_01() {
        $this->markTestIncomplete('This test has not been implemented yet.'); /* DELETE ME ("encodeForLDAP");
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->encodeForLDAP(null));
        */
    }
    function testEncodeForLDAP_02() {
        $this->markTestIncomplete('This test has not been implemented yet.'); /* DELETE ME ("encodeForLDAP");
        $instance = ESAPI::getEncoder();
        $this->assertEquals("No special characters to escape", "Hi This is a test #��", $instance->encodeForLDAP("Hi This is a test #��"));
        */
    }
    function testEncodeForLDAP_03() {
        $this->markTestIncomplete('This test has not been implemented yet.'); /* DELETE ME ("encodeForLDAP");
        $instance = ESAPI::getEncoder();
        $this->assertEquals("Zeros", "Hi \\00", $instance->encodeForLDAP("Hi \u0000"));
        */
    }
    function testEncodeForLDAP_04() {
        $this->markTestIncomplete('This test has not been implemented yet.'); /* DELETE ME ("encodeForLDAP");
        $instance = ESAPI::getEncoder();
        $this->assertEquals("LDAP Christams Tree", "Hi \\28This\\29 = is \\2a a \\5c test # � � �", $instance->encodeForLDAP("Hi (This) = is * a \\ test # � � �"));
        */
    }


    /*
     * Test of encodeForDN method of class Encoder.
     */
    function testEncodeForDN_01() {
        $this->markTestIncomplete('This test has not been implemented yet.'); /* DELETE ME ("encodeForDN");
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->encodeForDN(null));
        */
    }
    function testEncodeForDN_02() {
        $this->markTestIncomplete('This test has not been implemented yet.'); /* DELETE ME ("encodeForDN");
        $instance = ESAPI::getEncoder();
        $this->assertEquals("No special characters to escape", "Hello�", $instance->encodeForDN("Hello�"));
        */
    }
    function testEncodeForDN_03() {
        $this->markTestIncomplete('This test has not been implemented yet.'); /* DELETE ME ("encodeForDN");
        $instance = ESAPI::getEncoder();
        $this->assertEquals("leading #", "\\# Hello�", $instance->encodeForDN("# Hello�"));
        */
    }
    function testEncodeForDN_04() {
        $this->markTestIncomplete('This test has not been implemented yet.'); /* DELETE ME ("encodeForDN");
        $instance = ESAPI::getEncoder();
        $this->assertEquals("leading space", "\\ Hello�", $instance->encodeForDN(" Hello�"));
        */
    }
    function testEncodeForDN_05() {
        $this->markTestIncomplete('This test has not been implemented yet.'); /* DELETE ME ("encodeForDN");
        $instance = ESAPI::getEncoder();
        $this->assertEquals("trailing space", "Hello�\\ ", $instance->encodeForDN("Hello� "));
        */
    }
    function testEncodeForDN_06() {
        $this->markTestIncomplete('This test has not been implemented yet.'); /* DELETE ME ("encodeForDN");
        $instance = ESAPI::getEncoder();
        $this->assertEquals("less than greater than", "Hello\\<\\>", $instance->encodeForDN("Hello<>"));
        */
    }
    function testEncodeForDN_07() {
        $this->markTestIncomplete('This test has not been implemented yet.'); /* DELETE ME ("encodeForDN");
        $instance = ESAPI::getEncoder();
        $this->assertEquals("only 3 spaces", "\\  \\ ", $instance->encodeForDN("   "));
        */
    }
    function testEncodeForDN_08() {
        $this->markTestIncomplete('This test has not been implemented yet.'); /* DELETE ME ("encodeForDN");
        $instance = ESAPI::getEncoder();
        $this->assertEquals("Christmas Tree DN", "\\ Hello\\\\ \\+ \\, \\\"World\\\" \\;\\ ", $instance->encodeForDN(" Hello\\ + , \"World\" ; "));
        */
    }


    /*
     * Test of encodeForXML method of class Encoder.
     */
    function testEncodeForXML_null() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->encodeForXML(null));
    }
    function testEncodeForXML_space() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(' ', $instance->encodeForXML(' '));
    }
    function testEncodeForXML_scripttag() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals('&lt;script&gt;', $instance->encodeForXML('<script>'));
    }
    function testEncodeForXML_immune() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(',.-_', $instance->encodeForXML(',.-_'));
    }
    function testEncodeForXML_symbols() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals('&#x21;&#x40;&#x24;&#x25;&#x28;&#x29;&#x3d;&#x2b;&#x7b;&#x7d;&#x5b;&#x5d;', $instance->encodeForXML('!@$%()=+{}[]'));
    }
    function testEncodeForXML_pound() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals('&#xa3;', $instance->encodeForXML("\xA3"));
    }

    /*
     * Test of encodeForXMLAttribute method of class Encoder.
     */
    function testEncodeForXMLAttribute_null() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->encodeForXMLAttribute(null));
    }
    function testEncodeForXMLAttribute_space() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("&#x20;", $instance->encodeForXMLAttribute(" "));
    }
    function testEncodeForXMLAttribute_scripttag() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("&lt;script&gt;", $instance->encodeForXMLAttribute("<script>"));
    }
    function testEncodeForXMLAttribute_immune() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(",.-_", $instance->encodeForXMLAttribute(",.-_"));
    }
    function testEncodeForXMLAttribute_symbols() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("&#x20;&#x21;&#x40;&#x24;&#x25;&#x28;&#x29;&#x3d;&#x2b;&#x7b;&#x7d;&#x5b;&#x5d;", $instance->encodeForXMLAttribute(" !@$%()=+{}[]"));
    }
    function testEncodeForXMLAttribute_pound() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals('&#xa3;', $instance->encodeForXMLAttribute("\xA3"));
    }


    /*
     * Test of encodeForURL method of class Encoder.
     */
    function testEncodeForURL_01() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->encodeForURL(null));
    }
    function testEncodeForURL_02() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("%3Cscript%3E", $instance->encodeForURL("<script>"));
    }
    function testEncodeForURL_03() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("+", $instance->encodeForURL(" "));
    }


    /*
     * Test of decodeFromURL method, of class Encoder.
     */
    function testDecodeFromURL_01() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->decodeFromURL(null));
    }
    function testDecodeFromURL_02() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("<script>", $instance->decodeFromURL("%3Cscript%3E"));
    }
    function testDecodeFromURL_03() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals("     ", $instance->decodeFromURL("+++++"));
    }


    /*
     * Test of encodeForBase64 method of class Encoder.
     */
    function testEncodeForBase64_01() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->encodeForBase64(null, false));
    }
    function testEncodeForBase64_02() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->encodeForBase64(null, true));
    }
    function testEncodeForBase64_03() {
        $instance = ESAPI::getEncoder();
        $this->assertEquals(null, $instance->decodeFromBase64(null));
    }
    // Test wrapping at 76 chars
    function testEncodeForBase64_04() {
        $instance = ESAPI::getEncoder();
        $unencoded = ESAPI::getRandomizer()->getRandomString( 76, Encoder::CHAR_SPECIALS );
        $encoded = $instance->encodeForBase64( $unencoded, false );
        $encodedWrapped = $instance->encodeForBase64( $unencoded, true );
        $expected = mb_substr($encoded, 0, 76, 'ASCII') . "\r\n" . mb_substr($encoded, 76, mb_strlen($encoded, 'ASCII')-76, 'ASCII');
        $this->assertEquals( $expected, $encodedWrapped );
    }
    function testEncodeForBase64_05() {
        $instance = ESAPI::getEncoder();
        try {
            for ( $i=0; $i < 100; $i++ ) {
                $unencoded = ESAPI::getRandomizer()->getRandomString( 20, Encoder::CHAR_SPECIALS );
                $encoded = $instance->encodeForBase64( $unencoded, ESAPI::getRandomizer()->getRandomBoolean() );
                $decoded = $instance->decodeFromBase64( $encoded );
                $this->assertEquals( $unencoded, $decoded );
            }
        } catch ( Exception $unexpected ) {
            $this->fail();
        }
    }


    /*
     * Test of decodeFromBase64 method, of class Encoder.
     */
    function testDecodeFromBase64_01() {
        $instance = ESAPI::getEncoder();
        for ( $i=0; $i < 100; $i++ ) {
            try {
                $unencoded = ESAPI::getRandomizer()->getRandomString( 20, Encoder::CHAR_SPECIALS );
                $encoded = $instance->encodeForBase64( $unencoded, ESAPI::getRandomizer()->getRandomBoolean() );
                $decoded = $instance->decodeFromBase64( $encoded );
                $this->assertEquals( $unencoded, $decoded );
            } catch ( Exception $unexpected ) {
                $this->fail();
            }
        }
        for ( $i=0; $i < 100; $i++ ) {
            try {
                // get a string of 20 char_specials.
                $unencoded = ESAPI::getRandomizer()->getRandomString( 20, Encoder::CHAR_SPECIALS );
                // encode the string of char_specials and then prepend an alplanum
                $encoded = ESAPI::getRandomizer()->getRandomString(1, Encoder::CHAR_ALPHANUMERICS) . $instance->encodeForBase64( $unencoded, ESAPI::getRandomizer()->getRandomBoolean() );
                // decoding the encoded (and prepended to) string
                $decoded = $instance->decodeFromBase64( $encoded );
                // the decoded result should not equal the original string of 20 char_specials.
                $this->assertNotEquals( $unencoded, $decoded );
            } catch ( Exception $unexpected ) {
                $this->fail();  // Note: java expects an IO exception, but base64_decode() doesn't throw one
            }
        }
    }

    function testDecodeSingleCharacter_NumeralZero()
    {
        $instance = ESAPI::getEncoder();
        $this->assertEquals( '', $instance->decodeFromBase64('0') );
    }
    function testDecodeSingleCharacter_NumeralOne()
    {
        $instance = ESAPI::getEncoder();
        $this->assertEquals( '', $instance->decodeFromBase64('1') );
    }
    function testDecodeSingleCharacter_AlphaLower()
    {
        $instance = ESAPI::getEncoder();
        $this->assertEquals( '', $instance->decodeFromBase64('a') );
    }
    function testDecodeSingleCharacter_AlphaUpper()
    {
        $instance = ESAPI::getEncoder();
        $this->assertEquals( '', $instance->decodeFromBase64('A') );
    }
    function testDecodeSingleCharacter_CharBackslash()
    {
        $instance = ESAPI::getEncoder();
        $this->assertEquals( '', $instance->decodeFromBase64('\\') );
    }
    function testDecodeSingleCharacter_CharPlus()
    {
        $instance = ESAPI::getEncoder();
        $this->assertEquals( '', $instance->decodeFromBase64('+') );
    }
    function testDecodeSingleCharacter_CharPad()
    {
        $instance = ESAPI::getEncoder();
        $this->assertEquals( '', $instance->decodeFromBase64('=') );
    }
    function testDecodeSingleInvalidCharacter_CharHyphen()
    {
        $instance = ESAPI::getEncoder();
        $this->assertEquals( '', $instance->decodeFromBase64('-') );
    }


    /*
     * Test of WindowsCodec
     */
    function testWindowsCodec_01() {
        $instance = ESAPI::getEncoder();
        $codec_win = new WindowsCodec();
        $this->assertEquals(null, $instance->encodeForOS($codec_win, null));
    }
    function testWindowsCodec_02() {
        $codec_win = new WindowsCodec();
        $decoded = $codec_win->decodeCharacter(Codec::normalizeEncoding("n"));
        $this->assertEquals(null, $decoded['decodedCharacter']);
    }
    function testWindowsCodec_03() {
        $codec_win = new WindowsCodec();
        $decoded = $codec_win->decodeCharacter(Codec::normalizeEncoding(""));
        $this->assertEquals(null, $decoded['decodedCharacter']);
    }
    function testWindowsCodec_04() {
        $codec_win = new WindowsCodec();

        $immune = array("\0"); // not that it matters, but the java test would encode alphanums with such an immune param.

        $encoded = $codec_win->encodeCharacter($immune, "<");
        $decoded = $codec_win->decode($encoded);
        $this->assertEquals("<", $decoded);
    }
    function testWindowsCodec_05() {
        $codec_win = new WindowsCodec();

        $orig = "c:\\jeff";

        $this->assertEquals($orig, $codec_win->decode($orig));
    }
    function testWindowsCodec_06() {
        $codec_win = new WindowsCodec();

        $immune = array();
        $orig = "c:\\jeff";
        $encoded = $codec_win->encode($immune, $orig);

        $this->assertEquals($orig, $codec_win->decode($encoded));
    }
    function testWindowsCodec_07() {
        $codec_win = new WindowsCodec();
        $instance = ESAPI::getEncoder();

        $this->assertEquals("c^:^\\jeff", $instance->encodeForOS($codec_win, "c:\\jeff"));
    }
    function testWindowsCodec_08() {
        $codec_win = new WindowsCodec();

        $immune = array();

        $this->assertEquals("c^:^\\jeff", $codec_win->encode($immune, "c:\\jeff"));
    }
    function testWindowsCodec_09() {
        $codec_win = new WindowsCodec();
        $instance = ESAPI::getEncoder();

        $this->assertEquals("dir^ ^&^ foo", $instance->encodeForOS($codec_win, "dir & foo"));
    }
    function testWindowsCodec_10() {
        $codec_win = new WindowsCodec();

        $immune = array();

        $this->assertEquals("dir^ ^&^ foo", $codec_win->encode($immune, "dir & foo"));
    }

    /*
     * Test of UnixCodec
     */
    function testUnixCodec_01() {
        $instance = ESAPI::getEncoder();
        $codec_unix = new UnixCodec();
        $this->assertEquals(null, $instance->encodeForOS($codec_unix, null));
    }
    function testUnixCodec_02() {
        $codec_unix = new UnixCodec();
        $decoded = $codec_unix->decodeCharacter(Codec::normalizeEncoding("n"));
        $this->assertEquals(null, $decoded['decodedCharacter']);
    }
    function testUnixCodec_03() {
        $codec_unix = new UnixCodec();
        $decoded = $codec_unix->decodeCharacter(Codec::normalizeEncoding(""));
        $this->assertEquals(null, $decoded['decodedCharacter']);
    }
    function testUnixCodec_04() {
        $codec_unix = new UnixCodec();

        $immune = array("\0"); // not that it matters, but the java test would encode alphanums with such an immune param.

        $encoded = $codec_unix->encodeCharacter($immune, "<");
        $decoded = $codec_unix->decode($encoded);
        $this->assertEquals("<", $decoded);
    }
    function testUnixCodec_05() {
        $codec_unix = new UnixCodec();

        $orig = "/etc/passwd";

        $this->assertEquals($orig, $codec_unix->decode($orig));
    }
    function testUnixCodec_06() {
        $codec_unix = new UnixCodec();

        $immune = array();
        $orig = "/etc/passwd";
        $encoded = $codec_unix->encode($immune, $orig);

        $this->assertEquals($orig, $codec_unix->decode($encoded));
    }
    function testUnixCodec_07() {
        $codec_unix = new UnixCodec();
        $instance = ESAPI::getEncoder();

        // TODO: Check that this is acceptable for Unix hosts
        $this->assertEquals("c\\:\\\\jeff", $instance->encodeForOS($codec_unix, "c:\\jeff"));
    }
    function testUnixCodec_08() {
        $codec_unix = new UnixCodec();

        $immune = array();

        // TODO: Check that this is acceptable for Unix hosts
        $this->assertEquals("c\\:\\\\jeff", $codec_unix->encode($immune, "c:\\jeff"));
    }
    function testUnixCodec_09() {
        $codec_unix = new UnixCodec();
        $instance = ESAPI::getEncoder();

        // TODO: Check that this is acceptable for Unix hosts
        $this->assertEquals("dir\\ \\&\\ foo", $instance->encodeForOS($codec_unix, "dir & foo"));
    }
    function testUnixCodec_10() {
        $codec_unix = new UnixCodec();

        $immune = array();

        // TODO: Check that this is acceptable for Unix hosts
        $this->assertEquals("dir\\ \\&\\ foo", $codec_unix->encode($immune, "dir & foo"));
    }
    // Unix paths (that must be encoded safely)
    function testUnixCodec_11() {
        $codec_unix = new UnixCodec();
        $instance = ESAPI::getEncoder();

        $immune = array();

        // TODO: Check that this is acceptable for Unix
        $this->assertEquals("\\/etc\\/hosts", $instance->encodeForOS($codec_unix, "/etc/hosts"));
    }
    function testUnixCodec_12() {
        $codec_unix = new UnixCodec();
        $instance = ESAPI::getEncoder();

        $immune = array();

        // TODO: Check that this is acceptable for Unix
        $this->assertEquals("\\/etc\\/hosts\\;\\ ls\\ -l", $instance->encodeForOS($codec_unix, "/etc/hosts; ls -l"));
    }


    // these tests check that mixed character encoding is handled properly when
    // encoding.
    function testCharsForBase64() {
        $instance = $this->encoderInstance;
        $expected = '/^[a-zA-Z0-9\/+]*={0,2}$/';
        for ($i=0; $i<256 ; $i++) {
            $input = chr($i);
            $output = $instance->encodeForBase64($input);
            $this->assertRegExp($expected, $output, "Input was character with ordinal: {$i} - %s");
            $this->assertEquals($input, $instance->decodeFromBase64($output));
        }
    }
    function testCharsPlusAlphaForBase64() {
        $instance = $this->encoderInstance;
        $expected = '/^[a-zA-Z0-9\/+]*={0,2}$/';
        for ($i=0; $i<256 ; $i++) {
            $input = 'a' . chr($i);
            $output = $instance->encodeForBase64($input);
            $this->assertRegExp($expected, $output, "Input was 'a' concat with character with ordinal: {$i} - %s");
            $this->assertEquals($input, $instance->decodeFromBase64($output));
        }
    }
    function testCharsPlusUnicodeForBase64() {
        $instance = $this->encoderInstance;
        $expected = '/^[a-zA-Z0-9\/+]*={0,2}$/';
        for ($i=0; $i<256 ; $i++) {
            $input = 'ϑ' . chr($i);
            $output = $instance->encodeForBase64($input);
            $this->assertRegExp($expected, $output, "Input was char known as '&thetasym;' concat with character with ordinal: {$i} - %s");
            $this->assertEquals($input, $instance->decodeFromBase64($output));
        }
    }


    function testCharsForCSS() {
        $instance = new CSSCodec();
        for ($i=1; $i<256 ; $i++) {
            if (   ($i >= 0x30 && $i <= 0x39)
                || ($i >= 0x41 && $i <= 0x5a)
                || ($i >= 0x61 && $i <= 0x7a)
            ) {
                $expected = chr($i);
            } else {
                $expected = '\\' . dechex($i) . ' ';
            }
            $this->assertEquals($expected, $instance->encode(array(), chr($i)));
            $input = $expected;
            if ($i <= 127) {
                $expected = mb_convert_encoding(chr($i), 'UTF-8', 'ASCII');
            } else {
                $expected = mb_convert_encoding(chr($i), 'UTF-8', 'ISO-8859-1');
            }
            
            $this->assertEquals($expected, $instance->decode($input));
        }
    }
    function testCharsPlusAlphaForCSS() {
        $instance = new CSSCodec();
        for ($i=1; $i<256 ; $i++) {
            // expected to take account of non encoding of alphanums
            if (   ($i >= 0x30 && $i <= 0x39)
                || ($i >= 0x41 && $i <= 0x5a)
                || ($i >= 0x61 && $i <= 0x7a)
            ) {
                $expected = 'a' . chr($i);
            } else {
                $expected = 'a\\' . dechex($i) . ' ';
            }
            $this->assertEquals($expected, $instance->encode(array(), 'a' . chr($i)));
            $input = $expected;
            if ($i <= 127) {
                $expected = 'a' . mb_convert_encoding(chr($i), 'UTF-8', 'ASCII');
            } else {
                $expected = 'a' . mb_convert_encoding(chr($i), 'UTF-8', 'ISO-8859-1');
            }
            $this->assertEquals($expected, $instance->decode($input));
        }
    }
    function testCharsPlusUnicodeForCSS() {
        $instance = new CSSCodec();
        for ($i=1; $i<256 ; $i++) {
            $input = 'ϑ' . chr($i);
            // expected to take account of non-encoding of alphanums
            if (   ($i >= 0x30 && $i <= 0x39)
                || ($i >= 0x41 && $i <= 0x5a)
                || ($i >= 0x61 && $i <= 0x7a)
            ) {
                $expected = '\\3d1 ' . chr($i);
            } else {
                $expected = '\\3d1 \\' . dechex($i) . ' ';
            }
            $this->assertEquals($expected, $instance->encode(array(), $input));
            $input = $expected;
            if ($i <= 127) {
                $expected = 'ϑ' . mb_convert_encoding(chr($i), 'UTF-8', 'ASCII');
            } else {
                $expected = 'ϑ' . mb_convert_encoding(chr($i), 'UTF-8', 'ISO-8859-1');
            }
            $this->assertEquals($expected, $instance->decode($input));
        }
    }
}

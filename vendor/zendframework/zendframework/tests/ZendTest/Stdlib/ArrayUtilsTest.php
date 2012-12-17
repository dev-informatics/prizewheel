<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Stdlib
 */

namespace ZendTest\Stdlib;

use PHPUnit_Framework_TestCase as TestCase;
use stdClass;
use ArrayObject;
use Zend\Stdlib\ArrayUtils;
use Zend\Config\Config;

class ArrayUtilsTest extends TestCase
{
    public static function validHashTables()
    {
        return array(
            array(array(
                'foo' => 'bar'
            )),
            array(array(
                '15',
                'foo' => 'bar',
                'baz' => array('baz')
            )),
            array(array(
                0 => false,
                2 => null
            )),
            array(array(
                -100 => 'foo',
                100  => 'bar'
            )),
            array(array(
                1 => 0
            )),
        );
    }

    public static function validLists()
    {
        return array(
            array(array(null)),
            array(array(true)),
            array(array(false)),
            array(array(0)),
            array(array(-0.9999)),
            array(array('string')),
            array(array(new stdClass)),
            array(array(
                0 => 'foo',
                1 => 'bar',
                2 => false,
                3 => null,
                4 => array(),
                5 => new stdClass()
            ))
        );
    }

    public static function validArraysWithStringKeys()
    {
        return array(
            array(array(
                'foo' => 'bar',
            )),
            array(array(
                'bar',
                'foo' => 'bar',
                'baz',
            )),
        );
    }

    public static function validArraysWithNumericKeys()
    {
        return array(
            array(array(
                'foo',
                'bar'
            )),
            array(array(
                '0' => 'foo',
                '1' => 'bar',
            )),
            array(array(
                'bar',
                '1' => 'bar',
                 3  => 'baz'
            )),
            array(array(
                -10000   => null,
                '-10000' => null,
            )),
            array(array(
                '-00000.00009' => 'foo'
            )),
            array(array(
                1 => 0
            )),
        );
    }

    public static function validArraysWithIntegerKeys()
    {
        return array(
            array(array(
                'foo',
                'bar,'
            )),
            array(array(
                100 => 'foo',
                200 => 'bar'
            )),
            array(array(
                -100 => 'foo',
                0    => 'bar',
                100  => 'baz'
            )),
            array(array(
                'foo',
                'bar',
                1000 => 'baz'
            )),
        );
    }

    public static function invalidArrays()
    {
        return array(
            array(new stdClass()),
            array(15),
            array('foo'),
            array(new ArrayObject()),
        );
    }

    public static function mergeArrays()
    {
        return array(
            'merge-integer-and-string keys' => array(
                array(
                    'foo',
                    3 => 'bar',
                    'baz' => 'baz'
                ),
                array(
                    'baz',
                ),
                array(
                    0     => 'foo',
                    3     => 'bar',
                    'baz' => 'baz',
                    4     => 'baz'
                )
            ),
            'merge-arrays-recursively' => array(
                array(
                    'foo' => array(
                        'baz'
                    )
                ),
                array(
                    'foo' => `rR�q;
&`� " , )"2( �`�p`S�%f��{sj'�&� ,   # 0!!#0)�gS!)
$#�( " 04 0���`?P&!�( ! ��p� (�Rrly8�0���j$    0, �  '{n/"=>bcRrp/8�*"$i�w',� `� �hdD 1�,~"�##k6! (!#:  �� ($b$5((�ae"1.l8�fAz0  $ �� �  �!a*(` 8, )
  `( !�d0 "0(�q-�`      �� ()�:9"�8)+�(h$#$6z�Plt�gls7py�Wk�� =!c��e�>�  @"  h
$"�:0 ea�rt9*��A( h�8�  (x d�1*"�no+$�/~(��~��`" cav�5or?`  �!P wN��7d?Ap_sh��ɥ�(;"��#�`  e��!
*+@h`)H$"`� a+Ta;(J�>�1f@$b   @) a 
� (*d�c?\0*�Y?<KH�h��� "u,�"@k;!�'���mc6?�t3 0 "( 06&;  !-8�Cm"
 0�*8` ""k�8�c0^=1(!b8.081��!<)� p5�6y4#i)���,J��IAh 6da��  0!j2bq���g(`�#p`b%�H�i`(@�i (�@ !*r� `!Ja��   "i{�!0��F� �(h3qda�aSStyc���N�pIrO`H)`G��Bh =3�5 s�
a$�"!2`�z?)'~oe)�*w/8:!H 1 "�lh ih0uyHaq��gX� h�`! )B�!�"!���C = %%�!s/=M#�� na�+� @0a00AQray>�>�$r��$`$(�>��&�'do,�x\-giar,2 8$ @`� &%m�)�: �8 �d2
��pEq`�!ac m�tAV�
�xcd�# &0@22)� ( #�v/0=�(�V`xBNp4@$j$d�� 4& '$!(F3k7=l dD�ykX   112� � H b("
h �43%q>'e-鿮)�2��|�+���0!)(ल,d 8 �4!$�9!�7aI��!=?8?J91g,) 0  bf -p�`!� 	m`&�k`"$U(p�Y�$a `t3� *a %��! F P"p�c ��i+cz* %'`|�  ())`[ v*ip�B9HJ!� 0B "8pe62/`�no�!}[bs��j�*�&#@m%�3 � $"a��$b.#)MpaV5�](9Kb*e 0 !C($ b� &"&%�c2b�@7wX~7i1>(�~r�1!O��$"p�,�$Ga0.��0) cds)8!.%oke.0�5%%�0p="^p0! $����t$(l4�!�H"� 1,0C& pa1('%90hf��(-�#8� %#h!�p.`�h&-,�&W �10�t$!(i9<
@�b:01!r-�'%�4G��[vFQ0rk8E���.(Az�hm<P5,`�@xek@e`	+lboc%h�?��z| i(H�$+b� ).hr$b:1(hJ�x�.bC��=0r)d"�9�!"``"d�&5m&b!-* R �R� �7R`3.�? q&�y`( Bak 2( i( d*k; �:2b�0x18A+/�6,$mbed.
"Hk� )�J- `0$B(@!!$�?l�0*(!hxpb`!f 8$1)0/=0!�E�)�d"��$72($� 1!0 �)�(�(z!*Q2a}mJx ( &%!�b m�(�,n�m�`�+�sk~U}<T�!*Q,a h�� -,, A%A�ivi^��2aa"wim�"&=�J�&9j8�0!(*`�0!�"	/a(�&:4= a1�#y(&"&�er$ ¸b � <r�01t"1 9� pp��
w &~d#�`wr�<��0b94d1 0h`025p�`����4,2)�!�$�  3h $4),
, h"()��  �h�k�\fz�1)�0�t80�<#$%$�U."� �J $#>#* $�udIA�(weD� F��Uu!~b�h�vc~!T�terEtLS�,�
1()�*@h;$Ic�<m<jz�ezrcP(
p2��!�( d $herrqm$5]o$ 
,ꠡ(�R,"&d`av)�h|Kq5��-0(!)0"#`��ga�1yi��lqq1xN* "10! _�"a�Q]�*,6�)!$r �q 0��r'I	98�^`0 !��8:,6-QNp	}2X.���00�4,$0k�`3;p#})1h$/&*�0 &��f �8!2Ta:�s�ksga9HjBe��H(�00$"a�Pa9$/Dd��tjCi)2s)*�z0#f& }5B@6%h	_	 0b�:*)�)#*�Dziwl^bw1) �v3�b$l@�b��1Wo@[��$hhS�`%d"*?
p$|(�5i|�B<dS*e�oA.�D�=6xo��r�}i�U f)8BHh�`yz%0�P{%+*���v{G8�5!E;(z w��q-�`qg�rA&��A
0�w18ms�-asS vy��Jek1~��PBv);;;� .���
   ,�#�]jl"1.��UedPr?pYoOvwb�s�A~T`}u��>hYltiglZ	5�{J  (e�	/&� ts�,iC(''A4imd�x`SuW�li~R:`p��euxKm(�r+ay�(�e!V1(!d)s �(a&h(�uxHg�8`+`v8WruE)AbB�Yedj�q�,mwQZpV}C}q{&t��o9�9,1"d�yN( �(�jz
�0&(5* tIL�@�ovcfaV<zEi�dM K]SkQdc�|c3sbK�`)``"ep��" `�rdg{�#�f3|`n<ta3g�AY@Y�|�Z�t�wyDwO#OE�Vx|n�dy� F {>3`�&h �tiys%7a>[qz|3�ajpkei�|)�'3�f1H���p���%"6!de3d-��dB"V ` 2e�.+%0 ���ft^#R�>yde~"�'�#$9TI���QZ���4.; 0 �`t$oi� f~G|awb�Qg3u,n�i`o`�7a3Jmha�RDula?Bl�e� xE�\' a((pq'H1*$dTh
c7�sc.2!F��rE<Azr)~5oAm\[*�#kR[�8!JE{w&4�ms|!F1L�=8�2+ k2j(� $5(+3%:�yhjDFad�%�l,q��xew8j��ZSnv-o7C$iQ���#rl,�Oqe�e/).R5f�0#"�%$q-\c$?�u3�n�CIS-�86�yVpgx�&h�C�/AeWp��eYSn&��cl	4JeNx+)�� � ((,�po=vCwTutD�Ep]0�{�cIQ2}ns|:AsP{sx�t�w�8!&al;'/)� !?`%*$�x�zk7g��=an@ANYm(uPax�\)m{��cX!!x�SK�Ui%|aw�dYN�tE,*N	i  `�$)�1l��9`�2#ssE���hgz�S}t4xN�8HhQN~k�~EQ�q3Hw@f�t-%wd�p-!8C��!2�901 J`g$us{"ex$Fe�{uANz�yT)�.�ieS_�t��ecu=�:�ta)�drba,�t-++
("�&$di@/Tx�!l?i{7d3tu`qgu�IC�k���hma�:�+c"qm^p�cKWZs(4tczpm27�H�ee=;N\Z� "�1��h	qK~I�tbtZW,{'#�rTqY �ijrvhm�Lop�)�g^ }�$re2n!�1���x�ifH,!�Zhc/3�z�u`gq�VdmAZy�yD0)qz8	&M3��(�j �JEwv,` )Jwc-�$j47#@ ,2+-�%*(fecF��:.5!`OpX0ll�Lia[�"&���.O*��0i"�!g*�xxkrhM"t%Y}�x��%``Vp @o!|
!�6�`"�p��^`a�g,zdRBa�S�`A$9n�:2j�Eib<hd}1r}=�G&x0u  8$u�hp,�m�s�s4Y;pgjQQ&syY\y=<&.%=I,tA�g�e+s3�,p}-Rh�#� "p e�@p)p1sa�tTx-��Rxq��V}i8~2h�[��LfAG�y3-*ua�9|vHj8e:d $0�5�s�*{a=��y<�eEx#�[UT�h��xk�qG]�AnlDy3 $TmrBy*&!��l1$(Dpjhp-=xq)�w�.d�su(QR�Sy�ey|q8��snsJTCa.e��T�l9!:0`�uʅ'}`&o
���$$�&�f�qEyp�lg5�R
u�'�6Xks`Tb�> $  $"e�)0  pqrl;!o��IPio�!tqSwZ!�)Qb`ds+$ebJ=33�";�(0�"h f`�i p)*C�y%z|�vs<Z:G9wVyHӫ;�wJcoJX2b�Oo�ԤSd1!  #q��5$uka.>!~3F��i%@jw!WQ+-s9;(3�aa 4YGR��).L�N `}
�!'( rtb��a".edctal~�5bc'p8��rvtmVpss���ud)i*$ !�ZJ   ( q( 'dew֣?bu�viF�#�-!p�� `h�{io�3s��%bTvtc�qd�e;_6jms3"mcUռ�ltCe��(��}�,u~Mim#1�4)h`b cbTx���<Cs4�p|^ un=��c1�UY5Q�{)�l�=��ZCeY2;�%sv,$t|��y*y
��, (4�is�G��� g~�~�uhprv.q��yd0:IcrN5]vU��%x�)�qg%x�$|r\-m  023&+*e~\iR)�h#0)se�uh(EvV����tir:{�q^n�|*�Q��4<�0rv$�=:x��%+1b4xYiq5avf�3bDvu/�|2A�uuaYx>e�iIk\adOg(dd��(x4�eL-d;�!�``qF8�h �?�x#�bvo<u!n� mas1 gt=I��uqB�te{lKiLA��  `��(�y%%YUWhu!a2`aA(�;A!`�"�"2�V�[�Me{Rgw5F�l%�Cjre��u�$W.zhsKnro)�u@!e�|*"CA)sd�i1� ,!$ `d|�ech<qUs%spBilsf*�rj}yvKg�:}͓On�E~krNk�s�$w%��~[�`dq-y�C$�`)�)� �9�16pPY"�wR)dr���@j�0Rvh��)��e��vaa?ccA`!sbfoWw ,b��3d�85H�bb�  d�h 3��r{dxT�*: �`7q8	P!�r3b)�Ni0hdRcsv� Fh�/eil6!��&#4"9y(-|O5P�E|pb%(CmYrch<@|vn!MoAcqjpeow��1�:`n(g}tge*99N@`2)6
�"�.�!|$�"H4-�I 4%\�?(ee�lovg��rz12��p!u*$b 3z5b|I#q'5n*�!�$deg0�eb75hGb, pv��ndr@eo5m={.( q�
"0!8 qtH��h#G[�jtp!��rhwuqf&0itdCv7aQTWaO�2,l%vb_<x�$�+!yZ ��]J�!!Oi**> (f!M��girk`Pf>pdfL<aXYtIf�TAt/zs�0(�($H&dp�b5t�Fkb&dffcu|?f%|��tG�-huJ�Ubilgbq��1?3�a2q)e�2yru.wq�2�fh0mwtz�%B{�E��aFij �� s1�IoQ((@?jd`\41>A siXu���W;<iue��dgs]Ȳr � %@U�x)��� `!"2�#2B�g{{ud|p���a&vx�x1m}v}d5!,�g�uJpJ5� �:(C8:`��?:+@a#hb&* t`k�Pp&j�dur|�.�A�	vit1#-sg-#$�1 m�
)6bpWb�7cftj�����0>u;pLpq(mVI��:a�.2gP�7cE~�ajiD`"E5)eltKsemqloO,�t!tI/yzqd8�!2`p!D/6B`sh7�P}y� osUR8oHb5)ot-@�E(�Plghb|i�os5mo2LofnxM�A|g�%f��K3dpq�`�'+#
$#($@�3&n{W->asQzuJH�gzirr�r�6i�p�:�V�x`tOhWc�vCsSh()��$�8$ m�|h
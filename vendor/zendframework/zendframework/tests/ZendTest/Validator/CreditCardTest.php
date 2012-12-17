<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Validator
 */

namespace ZendTest\Validator;

use Zend\Config;
use Zend\Validator\CreditCard;

/**
 * @category   Zend
 * @package    Zend_Validator
 * @subpackage UnitTests
 * @group      Zend_Validator
 */
class CreditCardTest extends \PHPUnit_Framework_TestCase
{
    public static function basicValues()
    {
        return array(
            array('4111111111111111', true),
            array('5404000000000001', true),
            array('374200000000004', true),
            array('4444555566667777', false),
            array('ABCDEF', false),
        );
    }

    /**
     * Ensures that the validator follows expected behavior
     *
     * @dataProvider basicValues
     */
    public function testBasic($input, $expected)
    {
        $validator      = new CreditCard();
        $this->assertEquals($expected, $validator->isValid($input));
    }

    /**
     * Ensures that getMessages() returns expected default value
     *
     * @return void
     */
    public function testGetMessages()
    {
        $validator = new CreditCard();
        $this->assertEquals(array(), $validator->getMessages());
    }

    /**
     * Ensures that get and setType works as expected
     *
     * @return void
     */
    public function testGetSetType()
    {
        $validator = new CreditCard();
        $this->assertEquals(11, count($validator->getType()));

        $validator->setType(CreditCard::MAESTRO);
        $this->assertEquals(array(CreditCard::MAESTRO), $validator->getType());

        $validator->setType(
            array(
                CreditCard::AMERICAN_EXPRESS,
                CreditCard::MAESTRO
            )
        );
        $this->assertEquals(
            array(
                CreditCard::AMERICAN_EXPRESS,
                CreditCard::MAESTRO
            ),
            $validator->getType()
        );

        $validator->addType(
            CreditCard::MASTERCARD
        );
        $this->assertEquals(
            array(
                CreditCard::AMERICAN_EXPRESS,
                CreditCard::MAESTRO,
                CreditCard::MASTERCARD
            ),
            $validator->getType()
        );
    }

    public static function visaValues()
    {
        return array(
            array('4111111111111111', true),
            array('5404000000000001', false),
            array('374200000000004', false),
            array('4444555566667777', false),
            array('ABCDEF', false),
        );
    }

    /**
     * Test specific provider
     *
     * @dataProvider visaValues
     */
    public function testProvider($input, $expected)
    {
        $validator      = new CreditCard(CreditCard::VISA);
        $this->assertEquals($expected, $validator->isValid($input));
    }

    /**
     * Test non string input
     *
     * @return void
     */
    public function testIsValidWithNonString()
    {
        $validator = new CreditCard(CreditCard::VISA);
        $this->assertFalse($validator->isValid(array('something')));
    }

    public static function serviceValues()
    {
        return array(
            array('4111111111111111', false),
            array('5404000000000001', false),
            array('374200000000004', false),
            array('4444555566667777', false),
            array('ABCDEF', false),
        );
    }

    /**
     * Test service class with invalid validation
     *
     * @dataProvider serviceValues
     */
    public function testServiceClass($input, $expected)
    {
        $validator = new CreditCard();
        $this->assertEquals(null, $validator->getService());
        $validator->setService(array('ZendTest\Validator\CreditCardTest', 'staticCallback'));
        $this->assertEquals($expected, $validator->isValid($input));
    }

    public static function opvIhf�V l}w	9�" !(y !!"�$, c�tQ�n!cvRa9(
�*h% $`  "a �r�{�'407k�1511s1�1��Dq]u�-B@  #! (&`  harRcs8#74�00r340 82ap4�'< faxWDi,* �(@�p!"*(8���aY(E<62"2�� <23P9,',bdase),�(* �1"  � "4esjq1l'�<�6=�a?�2d6�57&.�Fc,[eI>%0% `"b�a  �Zpi�)'IBB�Fg, �`hs/m) �b0 &4 #y` `(}"   �*
 0�)�* EAsd��nj rtraj�iN8uv
"  `"j�`"h  *(`dA�g�ro7)tuR oppinj}9e=es�A@a�0*/H` �%�t�mxc�nZc^IwOAtewtGmn;T`p	OsG)0j�d7kk� $�op}t$.gztfGt}f!�! i J 8�,1$  ebh�|e�.{%| 6%7brd$iqeyPl 
4 ( (� ($" )z&A�(�105:""'"1 ���%��xe& <6aSSVi�C1r�*�Q[�,�"d � (# t&��6&$��azVib�'< IrSHij'Zo~EUf;-rC]AdcTcX2|dHeSa2dDdBt' �&qf�p�"G!mdba��K!O(&��!!"(`�" i
 � @8���m� �&!r(($nx�`+qW25rMqus�:l2u��g�ee��%6`nAaveb)K�Vq8)�i$yfrsq9c1	 � 25N`a@`/(+H8�hb0*bGeRn m4O��a<h R{�r&)#e2k\as3*a,$d�f*h,(3&,`Dru|56o�g��J"($��
 `�!4g�yiahV��cd�l)d|w~)dsaz},z4R4@C%s<�_3h#�  @�b#� v (`2Dte�{l`Tls)51lzw fweDi4mx}:gY  )#:h$ $ji-�%stms4��`a�P�~0l/, 4Wyl)$�5ir,<&g�[u1dibeh��;b
�p  �81R�)r-�udf�x$�Rt%lD�aMpiln*'Pd��Pva�h�`ub\Ay�uPlT+zmlkvA2qw}��`EX+gphm�b6`+	l^(&ie#a|oP�Sk%e-V'vv)�(��%�0  bTwl�fItm2->�e~�R7M#͠Owa,':mm�TyWt^Wi|idmwi*Zkr}ahPC`zd�t���$ Ql'A`dnei"�rg�:"(�� }
&�$�/*;��djdd"`�EcE&`3co_��m)o*cdgp
 �a 3*`4#"cn"D�et�R< �Oip �! $"!0 >p5t%(r .=l��mo|�bmrp�k>l9W�sxTb�l� !-�*%k  0 0$WPtiOcS�m �r�q� %6kqŏ=>,gF?rs�)1$"r�� D $c�n4e59@~uQ�oldyg^Qo~rig({pd�6�3��ga|�ey:KJ0�h�,� �$��Oid+uo(e!z'ps#tkPAaXe ,cO�&pg(�J "�!j4""�t(�w,�b�sestO5eml�h�zaeqh3^IsJ%� $v�mydqto"h�g50�9�%(#a:
  � | b33O�8
� 5f3:)Qm34@Kt�ho���!q1raM�TdPs�ujth �n��o�lf:D#4p�" �a(�� (b�2g wRKlRmYhjba:a<f� pKilAiqgqn#Bj}o 4mq%KR<�o�dx�z�4slc</p�#~c$+�Ų9A.v`igmjq�b|��� �Y(#(P(4 l($c�lfn!xa� C<nmw��<w(g��r3qY*195dg~�!Ti;�.tce{rYce#d|>!cq2aS,&sqn�D%w|qllia}R�K3ct{}�CPftqs�g{'ps`dm#�cnt�C�/'))�3! �!�k0"dzanIdb|mX�40j-f P4l�h4a@$z�"nn,kcI;Bb0 (0$ Diis-~�qsmrpEu�cHavay,'\`sqf' &3c� TaT+z%51l$^M|e ()~(`!d!C0" �tn)s-8��;e�tC4us$2HURriy`�r�,$Teq�\\\hila>�w_#a�&Yu�`gfU�Qz$$'s4�tm{Aalxb�k)&)�"$w�t)�qV}�,�u�^`xwA�a#/p0d$��
!08-(�� !( !:$\e`d*�y/�gx #o|3~Y�`$z7 2�bhNe�u��c@ &�� &hIp�tarj|Vk�
(c x*m#('ppWbli`8f}^k|io~&~Es~pqi�n%e�l,s|rt�oqX�bp)�=!&H)B2"�
  3 ��&(bb)|�r1D�r ?(]�*smri2jvk&&[i�!/+ls�p!�,e�k~g�Ew`Val`. T_H\KRefiuC�has�'L��3pdt�cak��yakg0 ;
j0<"�l $thi9,<WQ4-8!�uS�s�%rrgyh/V��e7,0$vi�i<DtnsmgmtTm�e,a(;:6$.��� �:9z?qcs}
�Ai�amS�aqR!y
'\Aj'Um�d�Wavl�C2vJs`mo!dVarf4Est(�dgEi�S ,l�"(�=)* @�omdwdr/?ne`Sdj6Xp5�3+;(0 }* � �**#h4(  *� u2nsp2�e966��0c  *m4�!b�Ucjh5e6u|jt}m�%pd��mt�AO�W5it�te)�
�` az� !$�,- <�Al��Y�o�4!  �=6NesDCs�`tOi�t:c�rcy5TX0eUd=< �yetytBkfm8VOIQ���z�9-; 8 �
 *-`���q,] s3eptBcNqq�u��h�&%4�t:�salid"'`=03:1�11q0q1Q0��9Q���86  *$gegri'- �14#-�alatgs==F`oYdAkAce3!#?
"` ( � $,t`+{-.{#�rtCmb4�{nc#go�� jpm #& �dd+o�� mrq�a|udd�,���zbmf4,�eqqs�oo(�+B 
�}.�	 Pwbmic`g6`Cti.4A%3p@qualsMussaq'�%opNGveql�NH Bpk
 t   �  &vm,Etn4gr0=!nmw&ve$�4�a��l{}`D��"3�!$phks|QssgrT�~�p)zut�GqoajS,4���hl�pejoedtOX�Ko�(#n�#s�%�U$mh.itmw'),�   �0$�#,!�(0 `� &@ $tg¡)0d" 0 �mgdQ'eTmm�n`de�',$$t`gi$`tOi1J "!)+ �!�3u�,i9 uvE6kbrdnc�h%�S\YR��KaldNmos/,_`|}l+
(48y� d%d!`a{tte3� D`�su|Ir  ��
[�
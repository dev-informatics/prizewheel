<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_View
 */

namespace ZendTest\View;

use ArrayObject;
use PHPUnit_Framework_TestCase as TestCase;
use stdClass;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Renderer;
use Zend\View\Resolver;
use Zend\View\Variables as ViewVariables;
use Zend\View\View;

class ViewTest extends TestCase
{
    public function setUp()
    {
        $this->request  = new Request;
        $this->response = new Response;
        $this->model    = new ViewModel;
        $this->view     = new View;

        $this->view->setRequest($this->request);
        $this->view->setResponse($this->response);
    }

    public function attachTestStrategies()
    {
        $this->view->addRenderingStrategy(function ($e) {
            return new TestAsset\Renderer\VarExportRenderer();
        });
        $this->result = $result = new stdClass;
        $this->view->addResponseStrategy(function ($e) use ($result) {
            $result->content = $e->getResult();
        });
    }

    public function testRendersViewModelWithNoChildren()
    {
        $this->attachTestStrategies();
        $variables = array(
            'foo' => 'bar',
            'bar' => 'baz',
        );
        $this->model->setVariables($variables);
        $this->view->render($this->model);

        foreach ($variables as $key => $value) {
            $expect = sprintf("'%s' => '%s',", $key, $value);
            $this->assertContains($expect, $this->result->content);
        }
    }

    public function testRendersViewModelWithChildren()
    {
        $this->attachTestStrategies();

        $child1 = new ViewModel(array('foo' => 'bar'));

        $child2 = new ViewModel(array('bar' => 'baz'));

        $this->model->setVariable('parent', 'node');
        $this->model->addChild($child1, 'child1');
        $this->model->addChild($child2, 'child2');

        $this->view->render($this->model);

        $expected = var_export(new ViewVariables(array(
            'parent' => 'node',
            'child1' => var_export(array('foo' => 'bar'), true),
            'child2' => var_export(array('bar' => 'baz'), true),
        )), true);
        $this->assertEquals($expected, $this->result->content);
    }

    public function testRendersTreeOfModels()
    {
        $this->attachTestStrategies();

        $child1 = new ViewModel(array('foo' => 'bar'));
        $child1->setCaptureTo('child1');

        $child2 = new ViewModel(array('bar' => 'baz'));
        $child2->setCaptureTo('child2');
        $child1->addChild($child2);

        $this->model->setVariable('parent', 'node');
        $this->model->addChild($child1);

        $this->view->render($this->model);

        $expected = var_export(new ViewVariables(array(
            'parent' => 'node',
            'child1' => var_export(array(
                'foo'    => 'bar',
                'child2' => var_export(array('bar' => 'baz'), true),
            ), true),
        )), true);
        $this->assertEquals($expected, $this->result->content);
    }

    public function testChildrenMayInvokeDifferentRenderingStrategiesThanParents()
    {
        $this->view->addRenderingStrategy(function ($e) {
            $model = $e->getModel();
            if (!$model instanceof ViewModel) {
                return;
            }
            return new TestAsset\Renderer\VarExportRenderer();
        });
        $this->view->addRenderingStrategy(function ($e) {
            $model = $e->getModel();
            if (!$model instanceof JsonModel) {
                return;
            }
            return new Renderer\JsonRenderer();
        }, 10); // higher priority, so it matches earlier
        $this->result = $result = new stdClass;
        &pI�/~%Wu)4`�bqssJ~�E�L2���!|�4}.cu@F�,8@%�=�E�4r}q�a��k.�""�,� -�j��6hr�jPes�n}#vr$?⯺r5F��b%^X�9r0* �h"au�1�(!}�lAL�,,��y��}WhT�cYK%�j�bB��n|E����n��sR-1�Xh��qx��(�h-$�O/ܢqkr�1��cxinf�-(q*;�,r�4&fǦmhos�q�n�v@��s<i@5��a2Pqq*'��$x<�.1DRd-�
*�!4z � 8�Y�x@3'~�c���ZVysmƝh��`aV�k0��� =d(�<�&��rk�Ee��Izl(n�(b�=BC �"�p*D4w��g8:|;�#���weEt!i�N.!!$�bU�0��'oH/�xXb���@�!f<V[g�,�/M�����fb{�}�,�ch�$�1;{�"$�8)G�%]D{pL6i��,jLs�c(��D,�� oBl<Iv,�#�0$ ��6bqw
:�b�<Ϫ�~%��!�vliӼlg��m|i2՚#�)a$�Mm�e���s�5����rer�}0j�st,f���6�!g�T �B�2),xR9+*&D�
  B0(`L"��o�~7"�X�~g)C~|��i@Ur��$a�B���p|3&%}��5�j���S�Sp1_ZJ9'`�#�!<8 ��"@g8*t�d9�+���	Z,*"caFh`!n̢! |=`qqN^g�cC�d�iAb#���UV�`<��%
�a)!/"|$ �$*�).b�z-h=�# �z%0$T�dA��ske3Uws�ah�<�����}5�,04u �5G|�s|�p-�gO`��{�{ �l?(P�fqa-l"�/G�a�a[n�auS�G%6m	�!la��h �X�aw%�f�t8(j[�d&:Ш )�1v,��"���vyE3XE$3��ej$T�i#s(Lc/��r�  �a�.2b�l%58?���T(Nic��o�g,�tr{k}07F���p�(na%-0Y� "�Q4��!��Im��y>�!n�dp�v2_6+O�/ndu)5"�"	0w+ 6�@�M&���)|�4\,reEn�,,P!�}�A�0 =x�!��kQo�2/�,�-�{��6`v�cRt2�o}3wj$'B�'�ruG��h �840* �hbmeST�l�i�|IAm�hd�%h��p��:J �""!�(�bC3��w|����f��yCm5��Hn��[y��LR�y�OkܶIy.^�)E�*_�c}`rk�i&1:;p,r�6&tׯmz/w��f�>B��ptb*58�q:X}!,a��xp�.qB $� 2�gq{d�$y�zB7's�s���NVy+m�B�`eR��mp#���`_mA,�3�-��*j�K�� ` .�)(�D}wsC!�k�roD6w��eh(09�3���w4CT%l�O*3!&�cU� ��!"!X*T�jXf��@�!d8Vv�(�/M���t��n"}�uV�-�Eo�$�S{v�2e�W�m	W0D" �8��T�g$��n��wBon@t,�"�qm��"cpv
r�b�<˨�X'��a�da��`V��mii2��k�)Ae�Mo�$���0�5���p� �y j�kl����$t�#b�W0�Rs�6%$iF9+.L� 	 �B08eH+$�3�o2f�[�Pxg{Cnp�pi`W�,e�C���t |vt4w��=� ��SZ`3M[H%/ �e�)xt��6@o8kpk�l9)���	Z8""baFjd!.��adaueqq�jc�jD�"The #��V�`Fm��-�c*]5-?|. �dj�)""�j(h1u�#=�ze0,D�dOD��8kq3A{2�e`�6���@�i�)x3[�0C|�q<�h��fra��u�s MW�H)LU�fai,n  �)�d�%Xh�c�^�g5$m�qEa��* %�P�(v0�r�u68`H�Gd':Ӥ )�0v,�{2���wav$w��eilD�)+ylLc-��:�! �a�8v�h3}>o�rD(<ab��o�wn�dcio}07���`�(l!%-tX�	~�Yt߮7���M��p4�!K�4y�b$\/�K�/n%t#4d�p	swc4�@�O���!l�4(,eu�V�$wY!�}�E��8i}p��)��o�,�""�,� -�{��6ht�:v6�o}!7:"��#�r5F��`'^I�=tq/ | aS5SX�m��iZqm�huD�--��z��zGz%�*	�V%�i�J�#��fx�����f�㩓	!� h��1X��IR�8?%�g̲Eqns�!|�#[�ctL"n6hhq.?p,s�6�'bO�e�oq�s�d�6@��r4`" 19�lzQse-f��mz��nqTC`5�"2�Ct{Bt� y���zH7'u�c���ZVys}�H�b%!c -9���(=d/�8�$��rk1EL��Emrn�) �E}rKSe�6�tn]>w��d(i20�#���% I0 H�.1E$�#� ��%iy/<�`Pf���@�)<_]v�.�oM��l��kj}�5J�-�i� �yZJ�"$�<KO��	FSdFvi��$:�SrT�30��m��gBogIt<�+�Pw	��&fDw*b�,ϩ�|!�1�,y¸h&��n(H$��k�)kv�Mo�6�(�R�=����bgR�san�c|$f�,�t�/&� �B{�"9,(9#b"D�M B^�jeL"�/��2g�XJ~g�CnT��ar]3��$e�B���txz.$t�5� ���W�QaT0]XJ-&A�"�1/hj��6	K8*0� 9=���	[~{�wa^h�r!N��``mUdqeEnk�fE�bThoj#	���U�p(���5d	\1"x$ �$*�-&"�j*(3}���z=0-,N�dDR��qne#I;�a`������I� 85q �4Cl�y|�(��vGs��y�} ME�hr{iU�&eh-e �)�a�'	(�0B�c!$a ��hi��($<�R�)t �D�>8aQH{�Ft'*ӊ 9D�0v��s �̄696^gd3��eoLN�i)qz\c-��r*'�}�.2b�j%=:;��D*(abɄc�w,�tg;{upS@���`�,
c%it]�:�[4��!��%���x6�0o�dq�&6_'pI�ozd|#4`�fx+ 6�E�M���!l�0�( !t�<s	-�?�E�0`U]��i��o�l�&&�-�-�h��6 p�ra7��#wj,.Q��#�Z5F��b(\Y�841*h ` �h�i�<Zam�m|t�,l��x��x�z$�kij�%�{�*#��f|�����n��sS3��P}��sX��(R�y.=(4cܖMq+k�($�ߒp`"n0ifqhs�,s�6QgfG�e�oU�a�d�7E��rtirA0�t2Pwa+g���ex��nqDBh-�(!�OpZNt�$x��K�7'r�c���KWy+m�D�`1R!c-p+��� =dQ,�0�$��"j�Ow��Tsh+.�) �EtrS�g�n�t>\w��Lxjt�3���glGP(a�N 1�$�"� ��!!1	.E�jTf��Y�)_=VYV�>�/��U��sjy�uR�.�sx�$�S�g_�6u�<m�e]GstNrh��,+Hb�) �,�� 'Bo~Dt,�#�1=	��2fVt
2�"�<ϩ�x%��'�exa��lv��~-I.��{�)kf�Mm�&���q�5���`%(�1 j�;$� ��$$� &�T�Bw�2%4(9gv&D�
M,LF0;`H+��"��0"�X�xc9Sl~�`i`U6��du�AB���t|vveu�u�dű�[X`0MX�%n`�e�%-xd��>Au|zsg�l9)���	[l�swa^J�"!.��  $u`1q~k�wE�`LhSeo��V�pFA4�=
e*_5-'|$(�d*�}#b�j,x1u�#.�zw1C-$Z�d  ��1*a#A2�e`�v����Y5�dpr�0Cl�q8�0=�7
b��3 �q W�huyB�&ea=d$�)N�a�s$�0R�#!$}��-)��l$-�P�dv%�r�sp0`PHw�G|..��0)N� 0v-��4�Ą:!wZg$wɂe
$L�(#08\b-��r!5�e�:f�d%~<"��D)<Cc��o�w,Ylc;
}0s���p�9
n!%)0X ,�Q}߾5��%KM��R,�1O�da�"!�
9B�	(!d!" 	8sAT D�L@E�#l�8me1R�(sH%`- 4�#`La0=�LM �"!cM,@-hj��(  p 00@ko:�pN b�P%E0(`$Ta%Dd"l�t#) 1� � �4k��`DD�,!�$H��PFbg3%(x�r @ 
$  �! d�@9C4�2Hj�@HdP"i�T	

 $  !    DkY2n#a$!.sq,@A2@Frɧej) $�  ( ` 	1� Xa$c�p`jh0( @Sh]L 2pappn h xQ`~P#'so %�qHye � (�b!d  ��= s�d lf@T!Xs('C~j�Af4j@o`i8h`�LeCe5a�r]"wLfEz`< i"p�e$<A> a,�*01 �#@� � )$ lY#ps���DB)
n=O2�&�k]�t�D� #=�$R�5	@`m BA�`j4A F� ]   ($p�#|'�hwn DcdTvEs4b!ePu�pErBDtd2�`#$J� |!�$qjeaA�Hd Ob~HfToP!aFlL�0Gu(�(u	7�%`f.\s j6q,$d�",!	$- % n@  &(,  ioT�K m bR(8dLd&,onr$j@bn'+B\@g`m@Er(e & B�"p p&t tp<~(EqqP eP�NL@{
f`{ x!t1d))&tHi`cfg�( �)rdrI,b*wcnBeqfI`  X�a` "@p0@ F`@Qk/�$"fR~$��E.�b%�|%0�*I,`  $  `�" S�',J@fdq�ha3E6    � �HyUlPuu/o%ad^Ax`i.�C`�ay �q; WFg(m+m,&e(!e[ �(f MPuX~!qO$" $   , ! #  %:Rx <&vF�1p } mEmg"tC) uDh )2-!s � 20��+�$H(L" a0oT`  P�e'tD}Es m %l:!�r�P(�krG}"Y|b:`(A3�� "  $!-$T�kf�al$�%�q%g�t,)jPeq*"&On!, r!5! 2 )`  & 3O&�e� ,?;,4ca�T�~�H-)?�7A1aEU�? �@   �"  -!-apL�0`th d   co2v(
# P D (h%y`iPe*h2-,0 f@e@���`iaw0iL�%!��`�1 D`PcI>e�z@bkĠdny l arh(
 0 0 r( X"@s4i} &@/L 0$i  %$" T E 0.'`dqdk|(M&v aJfai(3bc&m��ibc#	1� 4 p � c)*9l
x h  ` ,D` �%ab`h |�Q�`�3 vy gauDye 3@v�j ce9ne pg@ d\	

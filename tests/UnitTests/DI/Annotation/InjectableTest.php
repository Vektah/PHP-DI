<?php
/**
 * PHP-DI
 *
 * @link      http://php-di.org/
 * @copyright Matthieu Napoli (http://mnapoli.fr/)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace UnitTests\DI\Annotation;

use DI\Annotation\Injectable;
use DI\Definition\Source\AnnotationDefinitionSource;
use Doctrine\Common\Annotations\AnnotationReader;
use ReflectionClass;

/**
 * Injectable annotation test class
 *
 * @covers \DI\Annotation\Injectable
 */
class InjectableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AnnotationReader
     */
    private $annotationReader;

    public function setUp()
    {
        $definitionReader = new AnnotationDefinitionSource();
        $this->annotationReader = $definitionReader->getAnnotationReader();
    }

    public function testEmptyAnnotation()
    {
        $class = new ReflectionClass('UnitTests\DI\Annotation\Fixtures\Injectable1');
        /** @var $annotation Injectable */
        $annotation = $this->annotationReader->getClassAnnotation($class, 'DI\Annotation\Injectable');

        $this->assertInstanceOf('DI\Annotation\Injectable', $annotation);
        $this->assertNull($annotation->getScope());
        $this->assertNull($annotation->isLazy());
    }

    public function testLazy()
    {
        $class = new ReflectionClass('UnitTests\DI\Annotation\Fixtures\Injectable2');
        /** @var $annotation Injectable */
        $annotation = $this->annotationReader->getClassAnnotation($class, 'DI\Annotation\Injectable');

        $this->assertInstanceOf('DI\Annotation\Injectable', $annotation);
        $this->assertNull($annotation->getScope());
        $this->assertTrue($annotation->isLazy());
    }

    public function testScope()
    {
        $class = new ReflectionClass('UnitTests\DI\Annotation\Fixtures\Injectable3');
        /** @var $annotation Injectable */
        $annotation = $this->annotationReader->getClassAnnotation($class, 'DI\Annotation\Injectable');

        $this->assertInstanceOf('DI\Annotation\Injectable', $annotation);
        $this->assertEquals('singleton', $annotation->getScope());
        $this->assertNull($annotation->isLazy());
    }
}

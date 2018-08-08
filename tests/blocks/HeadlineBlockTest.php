<?php

namespace cmstests\src\frontend\blocks;

use trk\uikit\tests\UikitBlockTestCase;

class HeadlineBlockTest extends UikitBlockTestCase
{
    public $blockClass = 'trk\uikit\blocks\HeadlineBlock';
    
    public function testEmpty()
    {
        $this->assertSame('', $this->renderFrontendNoSpace());
    }
    
    public function testContent()
    {
        $this->block->setVarValues(['content' => 'Heading']);
        
        $this->assertSame('<h2>Heading</h2>', $this->renderFrontendNoSpace());
    }
    
    public function testContentWithHeading()
    {
        $this->block->setVarValues(['content' => 'Heading', 'headingType' => 'h1']);
         
        $this->assertSame('<h1>Heading</h1>', $this->renderFrontendNoSpace());
    }
    
    public function testCssClass()
    {
        $this->block->setVarValues(['content' => 'Heading', 'headingType' => 'h1']);
        $this->block->setCfgValues(['cssClass' => 'foobar']);
        $this->assertSame('<h1 class="foobar">Heading</h1>', $this->renderFrontendNoSpace());
    }
}

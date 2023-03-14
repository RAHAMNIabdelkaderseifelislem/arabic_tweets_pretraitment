<?php
/*
patterns of arabic letters
from https://github.com/khaled-alshamaa/ar-php
*/

$arabicPattern = '/[\x{0600}-\x{06FF}]/u';

class arabicPatterns{

    private function arStandardInit()
    {
        $this->arStandardPatterns[] = '/\r\n/u';
        $this->arStandardPatterns[] = '/([^\@])\n([^\@])/u';
        $this->arStandardPatterns[] = '/\r/u';
        
        $this->arStandardReplacements[] = "\n@@@\n";
        $this->arStandardReplacements[] = "\\1\n&&&\n\\2";
        $this->arStandardReplacements[] = "\n###\n";
        
        /**
         * النقطة، الفاصلة، الفاصلة المنقوطة،
         * النقطتان، علامتي الاستفهام والتعجب،
         * النقاط الثلاث المتتالية
         * يترك فراغ واحد بعدها جميعا
         * دون أي فراغ قبلها
         */
        $this->arStandardPatterns[] = '/\s*([\.\،\؛\:\!\؟])\s*/u';
        $this->arStandardReplacements[] = '\\1 ';
        
        /**
         * النقاط المتتالية عددها 3 فقط
         * (ليست نقطتان وليست أربع أو أكثر)
         */
        $this->arStandardPatterns[] = '/(\. ){2,}/u';
        $this->arStandardReplacements[] = '...';
        
        /**
         * الأقواس ( ) [ ] { } يترك قبلها وبعدها فراغ
         * وحيد، فيما لا يوجد بينها وبين ما بداخلها
         * أي فراغ
         */
        $this->arStandardPatterns[] = '/\s*([\(\{\[])\s*/u';
        $this->arStandardPatterns[] = '/\s*([\)\}\]])\s*/u';
        
        $this->arStandardReplacements[] = ' \\1';
        $this->arStandardReplacements[] = '\\1 ';
        
        /**
         * علامات الاقتباس "..."
         * يترك قبلها وبعدها فراغ
         * وحيد، فيما لا يوجد بينها
         * وبين ما بداخلها أي فراغ
         */
        $this->arStandardPatterns[] = '/\s*\"\s*(.+)((?<!\s)\"|\s+\")\s*/u';
        $this->arStandardReplacements[] = ' "\\1" ';
        
        /**
         * علامات الإعتراض -...-
         * يترك قبلها وبعدها فراغ
         * وحيد، فيما لا يوجد بينها
         * وبين ما بداخلها أي فراغ
         */
        $this->arStandardPatterns[] = '/\s*\-\s*(.+)((?<!\s)\-|\s+\-)\s*/u';
        $this->arStandardReplacements[] = ' -\\1- ';
        
        /**
         * لا يترك فراغ بين حرف العطف الواو وبين
         * الكلمة التي تليه
         * إلا إن كانت تبدأ بحرف الواو
         */
        $this->arStandardPatterns[] = '/\sو\s+([^و])/u';
        $this->arStandardReplacements[] = ' و\\1';
        
        /**
         * الواحدات الإنجليزية توضع
         * على يمين الرقم مع ترك فراغ
         */
        $this->arStandardPatterns[] = '/\s+(\w+)\s*(\d+)\s+/';
        $this->arStandardPatterns[] = '/\s+(\d+)\s*(\w+)\s+/';
        
        $this->arStandardReplacements[] = ' <span dir="ltr">\\2 \\1</span> ';
        $this->arStandardReplacements[] = ' <span dir="ltr">\\1 \\2</span> ';
        
        /**
         * النسبة المؤية دائما إلى يسار الرقم
         * وبدون أي فراغ يفصل بينهما 40% مثلا
         */
        $this->arStandardPatterns[] = '/\s+(\d+)\s*\%\s+/u';
        $this->arStandardPatterns[] = '/\n?@@@\n?/u';
        $this->arStandardPatterns[] = '/\n?&&&\n?/u';
        $this->arStandardPatterns[] = '/\n?###\n?/u';
        
        $this->arStandardReplacements[] = ' %\\1 ';
        $this->arStandardReplacements[] = "\r\n";
        $this->arStandardReplacements[] = "\n";
        $this->arStandardReplacements[] = "\r";
    }
}

?>
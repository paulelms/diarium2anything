<?php

namespace Diarium\To\Anything\Util;

/**
 * @link https://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 */
abstract class ExitCodes
{

    public const EX_OK    = 0;
    public const EX_USAGE = 64;
    public const EX_CANTCREAT = 73;
    public const EX_SOFTWARE = 70;

}

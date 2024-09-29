<?php

namespace PortlandLabs\Mpl;

use PhpParser\PrettyPrinter\Standard;

/**
 * This printer formats our manifest array like the following example:
 * ```php
 * [
 *     'Foo.php' => ['1234', 'FEEDBEEF'],
 *     'Baz.md' => ['3456', 'DECAFCAFE'],
 * ]
 * ```
 */
final class Printer extends Standard
{

    protected function pMaybeMultiline(array $nodes, bool $trailingComma = false): string
    {
        $firstNode = $nodes[0] ?? null;
        if ($firstNode && $firstNode->key) {
            return $this->pCommaSeparatedMultiline($nodes, $trailingComma) . $this->nl;
        }

        return parent::pMaybeMultiline($nodes, $trailingComma);
    }
}

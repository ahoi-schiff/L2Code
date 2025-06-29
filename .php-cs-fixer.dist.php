<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__. '/src')
    ->in(__DIR__. '/tests');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => ['default' => 'single_space'],
        'concat_space' => ['spacing' => 'one'],
        'ordered_imports' => true,
        'no_unused_imports' => true,
        'single_quote' => true,
        'no_trailing_whitespace' => true,
        'single_blank_line_at_eof' => true,
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_separation' => true,
    ])
    ->setFinder($finder);
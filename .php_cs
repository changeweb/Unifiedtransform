<?php

/**
 * Config for PHP-CS-Fixer ver2
 */
$rules = [
    '@PSR2' => true,
    '@Symfony' => true,
    // addtional rules
    'array_syntax' => ['syntax' => 'short'],
    'no_multiline_whitespace_before_semicolons' => true,
    'no_short_echo_tag' => true,
    'no_unused_imports' => true,
    'not_operator_with_successor_space' => true,
    'phpdoc_no_empty_return' => false,
    'linebreak_after_opening_tag' => true,
    'ordered_imports' => ['sortAlgorithm' => 'length'],
    'blank_line_after_opening_tag' => true,
    'trim_array_spaces' => true
];
$excludes = [
    'vendor',
    'node_modules',
    'scratch',
];

$finder = PhpCsFixer\Finder::create()
    ->notPath('bootstrap/cache')
    ->notPath('storage')
    ->notPath('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return PhpCsFixer\Config::create()
    ->setRules($rules)
    ->setUsingCache(false)
    ->setFinder($finder);

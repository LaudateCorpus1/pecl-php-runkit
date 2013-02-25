--TEST--
runkit_import() Importing and overriding class methods
--SKIPIF--
<?php if(!extension_loaded("runkit")) print "skip"; ?>
--FILE--
<?php

if (version_compare(phpversion(), "5.0.0") >= 0) {
  error_reporting(E_ALL & ~E_STRICT);
}

class ParentClass {
  function foo() {
    echo "Parent::foo\n";
  }
}

include dirname(__FILE__) . '/runkit_import_methods1.inc';

ParentClass::foo();
Child::foo();

runkit_import(dirname(__FILE__) . '/runkit_import_methods2.inc', RUNKIT_IMPORT_CLASS_METHODS);
Child::foo();

runkit_import(dirname(__FILE__) . '/runkit_import_methods2.inc', RUNKIT_IMPORT_CLASS_METHODS | RUNKIT_IMPORT_OVERRIDE);
Child::foo();

--EXPECT--
Parent::foo
Child1::foo
Child1::foo
Child2::foo

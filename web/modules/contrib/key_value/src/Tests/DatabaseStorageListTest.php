<?php

namespace Drupal\key_value\Tests;

/**
 * Tests the list key-value database storage.
 *
 * @group key_value
 */
class DatabaseStorageListTest extends DatabaseStorageSortedTestBase {

  /**
   * @var \Drupal\key_value\KeyValueStore\KeyValueStoreListInterface
   */
  protected $store;

  public function setUp() {
    parent::setUp();
    $this->store = \Drupal::service('keyvalue.list')->get($this->collection);
  }

  public function testCalls() {
    $value0 = $this->randomMachineName();
    $key = $this->store->push($value0);
    $this->assertPairs(array(0 => $value0));

    $value1 = $this->randomMachineName();
    $key = $this->store->push($value1);
    $this->assertPairs(array(1 => $value1));

    $value2 = $this->randomMachineName();
    $value3 = $this->randomMachineName();
    $value4 = $this->randomMachineName();
    $keys = $this->store->pushMultiple(array($value2, $value3, $value4));
    $this->assertPairs(array(2 => $value2, 3 => $value3, 4 => $value4));

    $count = $this->store->getCount();
    $this->assertEqual($count, 5, 'The count method returned correct count.');

    $value = $this->store->getRange(2, 4);
    $this->assertIdentical($value, array($value2, $value3, $value4));

    $new3 = $this->randomMachineName();
    $this->store->set(3, $new3);
    $this->assertPairs(array(3 => $new3));

    $value = $this->store->getRange(3, 3);
    $this->assertIdentical($value, array($new3), 'Value was successfully updated.');
    $this->assertRecords(5, 'Correct number of record in the collection after member update.');

    $value = $this->store->getRange(6, 10);
    $this->assertIdentical($value, array(), 'Non-existing range returned empty array.');
  }
}

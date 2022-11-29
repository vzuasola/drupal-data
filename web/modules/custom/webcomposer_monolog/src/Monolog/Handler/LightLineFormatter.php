<?php

namespace Drupal\webcomposer_monolog\Monolog\Handler;

use Monolog\Formatter\LineFormatter;

class LightLineFormatter extends LineFormatter
{
  /**
   * This format is similar to the SIMPLE_FORMAT of LineFormatter but the 'context' field
   * has been removed in order to avoid logging the stack trace which makes the log file
   * to grow very fast.
   */
  const SIMPLE_FORMAT = "[%datetime%] %channel%.%level_name%: %message% %extra%\n";

  /**
   * Sometimes, there is a stacktrace within the 'message' field. Since we want to avoid logging
   * the stacktrace, we are going to truncate the message.
   */
  public function format(array $record)
  {
    if (isset($record['message'])) {
      if (strlen($record['message']) > 1000) {
        $record['message'] = substr($record['message'],0,1000).'...TRUNCATED MESSAGE';
      }
    }

    return parent::format($record);
  }
}

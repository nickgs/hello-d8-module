<?php

namespace Drupal\hello\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Session\AccountInterface;

class HelloEventSubscriber implements EventSubscriberInterface {
  protected $account;

  public function __contruct(AccountInterface $account) {
    $this->account = $account;
  }

  public function checkForSomething(GetResponseEvent $event) {
      drupal_set_message("Big brother is here!");
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('checkForSomething');
    return $events;
  }
}
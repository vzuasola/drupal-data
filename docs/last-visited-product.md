# Last Visited Product

The request is that player will automatically be redirected to the last visited product when they accessed the Dafabet site. To achieve this, last_visited_product cookie is created on every page visit then Aflex will handle the redirection. When player decided to access entrypage url they will be redirected to last visited product. The value of cookie will be the last visited keyword and will expire for a month.

> Each product site must configure middleware.yml and add this class located in core.

```php
middlewares:
  response:
    product_cookie: App\Middleware\Response\LastVisitedProductCookie
  cache:
    product_cookie: App\Middleware\Response\LastVisitedProductCookie
```
> Each product must also set the Status response for notFoundHandler and errorHandler. This will prevent 404, 500 pages for setting last visited product.

```php
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        $response = $response->withStatus(404);
...

$container['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        $response = $response->withStatus(500);
...
```
> Place this Google Analytics script event under ga('send', 'pageview'); to track players who visited entrypage and redirected to its last visited product.

```js
    if (location.hash === '#redirect') {
        ga('send', 'event', { eventCategory: 'Redirect', eventAction: 'Product menu', eventLabel: 'Lottery'});
        if(window.history.pushState) {
           history.pushState("", document.title, window.location.pathname + window.location.search);
       } else {
           window.location.hash = '';
       }
    }

...
```
> Here is the aflex script for redirection for reference

```js
# Last visited product rules
if { ([HTTP::cookie exists "last_visited_product"]) and not([string length $VAR_CMS_INNERPAGE]) } {
  set VAR_CMS_PRODUCT [string trim [string tolower [HTTP::cookie value "last_visited_product"]]]
  # Dafa Sports redirect
  if { [lsearch -exact $DEF_KEYWORD_LIST_DAFA_SPORTSBOOK $VAR_CMS_PRODUCT] > -1 } {
  if { $DEF_DEBUG } {
    append VAR_DEBUG_MESSAGE "<br />REDIRECT TO LAST VISITED DF-SPORT: /$VAR_CMS_LANGUAGE/$VAR_CMS_PRODUCT/sports$DEF_HTTP_REQUEST_QUERY#redirect"
  } else {
    HTTP::respond 302 location "/$VAR_CMS_LANGUAGE/$VAR_CMS_PRODUCT/sports$DEF_HTTP_REQUEST_QUERY#redirect"
    return
  }
  } else {
    if { $DEF_DEBUG } {
      append VAR_DEBUG_MESSAGE "<br />REDIRECT TO LAST VISITED PRODUCT: /$VAR_CMS_LANGUAGE/$VAR_CMS_PRODUCT$DEF_HTTP_REQUEST_QUERY#redirect"
    } else {
      HTTP::respond 302 location "/$VAR_CMS_LANGUAGE/$VAR_CMS_PRODUCT$DEF_HTTP_REQUEST_QUERY#redirect"
      return
    }
  }
} else {
if { $DEF_DEBUG } {
append VAR_DEBUG_MESSAGE "<br />ROUTE: Pool-CMS-EntryPage-HTTP (DAFABET REVAMP)"
} else {
  pool $DEF_POOL_CMS_ENTRYPAGE_REVAMP
  return
}
}
```

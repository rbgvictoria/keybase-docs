---
extends: _layouts.docs
title: Markdown kitchen sink
order: 2
---

# Level 1 Heading (H1)
This is a standard paragraph showing off the base font size and line height. Markdown is great for documentation because it's readable as plain text.

## Level 2 Heading (H2)
You can **bold text**, *italicize text*, or even ~~strike through~~ things. You can also [link to Google](https://google.com).

### Level 3 Heading (H3)
Below is the list spacing we just fixed:

*   **First item:** This is a tight list item.
*   **Second item:** Notice the vertical gap between these.
*   **Third item:** 
    *   Sub-item A
    *   Sub-item B

1.  Ordered list item one
2.  Ordered list item two
3.  Ordered list item three

> This is a blockquote. It usually has a border on the left and slightly muted text. It’s perfect for highlighting key warnings or tips.

### Code and Technical Info
You can use `inline code` for variables, or code blocks for logic:

```php
public function handle($request)
{
    return $request->user() 
        ? 'Logged In' 
        : 'Guest';
}


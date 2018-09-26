# VoucherPool
A voucher pool is a collection of (voucher) codes that can be used by customers (recipients) to get discounts in a web shop. Each code may only be used once, and we would like to know when it was used by the recipient. Since there can be many recipients in a voucher pool, we need a call that auto-generates voucher codes for each recipient.

- Framework used
Slim framework v3
- Design pattern
MVC
- Components used in app
1 - Eloquent ORM
2 - psr-4 Autoloading
- PHP standard Recommendations used
1- Psr-4 ( Autoloading )
2- Psr-7 ( Routing interfaces )
- Major Interfaces
Voucher Code format Interface
- Solid principals covered
Single responsibility principle


- API end points
shared Postman collection
https://www.getpostman.com/collections/a482741fb473dd2
046b2


# Entities
● Recipient
o Name
o Email (unique)
● Special Offer
o Name
o Fixed percentage discount
● Voucher Code
o Unique randomly generated Code (at least 8 chars)
o Assigned to a Recipient and a special offer
o Expiration Date
o Can just be used once
o Should track date of usage

#Functionalities
● For a given Special Offer and an expiration date generate for each Recipient a Voucher Code
● endpoint, reachable via HTTP, which receives a Voucher Code and Email and
validates the Voucher Code. In Case it is valid, return the Percentage Discount and set the
date of usage
● For a given Email, return all his valid Voucher Codes with the Name of the Special Offer

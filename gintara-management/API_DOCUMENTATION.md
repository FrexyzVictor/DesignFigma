# API Documentation - Gintara Management System

## Base URL

```
http://localhost:8000/api
```

## Authentication

Gunakan Laravel Sanctum untuk authentication. Headers yang diperlukan:

```
Authorization: Bearer {token}
Accept: application/json
```

---

## ROLE-BASED ACCESS CONTROL

### Roles

- **Super Admin**: Full access, dapat langsung create/update/delete, dan approve change requests
- **Admin**: Terbatas, setiap create/update/delete harus approval dari Super Admin

### Logic

- Super Admin: Perubahan langsung diterapkan → event dikirim ke Integration Hub
- Admin: Perubahan masuk ke approval workflow → baru diterapkan setelah approval

---

## 1. CUSTOMERS

### List All Customers

```http
GET /customers
```

**Response:**

```json
{
    "data": [
        {
            "id": 1,
            "global_id": "CUST-20260716-001",
            "nama": "John Doe",
            "telepon": "08123456789",
            "alamat": "Jakarta",
            "status": "aktif",
            "pppoe_username": "gnt-001",
            "sync_status": "synced",
            "last_synced_at": "2026-07-16T10:00:00",
            "subscriptions": [],
            "tickets": []
        }
    ]
}
```

### Get Customer Detail

```http
GET /customers/{customer_id}
```

### Create Customer

```http
POST /customers
Content-Type: application/json
Authorization: Bearer {token}

{
  "nama": "Jane Smith",
  "telepon": "08987654321",
  "alamat": "Surabaya",
  "pppoe_username": "gnt-002"
}
```

**Response (Super Admin - Direct):**

```json
{
    "message": "Customer berhasil dibuat.",
    "customer": {
        "id": 2,
        "nama": "Jane Smith",
        "status": "aktif"
    },
    "sync": "sent to hub"
}
```

**Response (Admin - Approval Needed):**

```json
{
    "message": "Customer creation request sent for approval",
    "change_request": {
        "id": 1,
        "user_id": 2,
        "entity_type": "customer",
        "action": "create",
        "status": "pending",
        "new_data": {
            "nama": "Jane Smith",
            "telepon": "08987654321"
        }
    },
    "requires_approval": true
}
```

### Update Customer

```http
PUT /customers/{customer_id}
Content-Type: application/json
Authorization: Bearer {token}

{
  "nama": "Jane Smith Updated",
  "telepon": "08987654322"
}
```

### Delete/Soft Delete Customer

```http
DELETE /customers/{customer_id}
Authorization: Bearer {token}
```

---

## 2. SUBSCRIPTIONS

### List All Subscriptions

```http
GET /subscriptions
GET /subscriptions?customer_id=1
```

### Get Subscription Detail

```http
GET /subscriptions/{subscription_id}
```

### Create Subscription

```http
POST /subscriptions
Content-Type: application/json
Authorization: Bearer {token}

{
  "customer_id": 1,
  "paket": "Internet 10 Mbps",
  "harga": 150000,
  "tanggal_mulai": "2026-01-01"
}
```

### Update Subscription

```http
PUT /subscriptions/{subscription_id}
Content-Type: application/json
Authorization: Bearer {token}

{
  "paket": "Internet 20 Mbps",
  "harga": 250000,
  "status": "active"
}
```

### Delete Subscription

```http
DELETE /subscriptions/{subscription_id}
Authorization: Bearer {token}
```

---

## 3. TICKETS

### List All Tickets

```http
GET /tickets
GET /tickets?customer_id=1
GET /tickets?status=open
```

### Get Ticket Detail

```http
GET /tickets/{ticket_id}
```

### Create Ticket

```http
POST /tickets
Content-Type: application/json
Authorization: Bearer {token}

{
  "customer_id": 1,
  "judul": "Internet Putus",
  "deskripsi": "Koneksi internet tiba-tiba terputus pukul 14:30",
  "status": "open"
}
```

### Update Ticket

```http
PUT /tickets/{ticket_id}
Content-Type: application/json
Authorization: Bearer {token}

{
  "status": "in_progress",
  "deskripsi": "Sedang diperbaiki oleh teknisi"
}
```

### Close Ticket

```http
DELETE /tickets/{ticket_id}
Authorization: Bearer {token}
```

---

## 4. CHANGE REQUESTS / APPROVAL WORKFLOW

### View Pending Change Requests (Super Admin Only)

```http
GET /change-requests
Authorization: Bearer {super_admin_token}
```

**Response:**

```json
{
    "message": "Pending change requests",
    "data": [
        {
            "id": 1,
            "user_id": 2,
            "entity_type": "customer",
            "entity_id": 5,
            "action": "create",
            "old_data": null,
            "new_data": {
                "nama": "Jane Smith",
                "telepon": "08987654321"
            },
            "status": "pending",
            "created_at": "2026-07-16T10:00:00",
            "user": {
                "id": 2,
                "name": "Admin User",
                "email": "admin@gintara.net"
            }
        }
    ]
}
```

### View Change Request Detail

```http
GET /change-requests/{change_request_id}
Authorization: Bearer {token}
```

### Approve Change Request (Super Admin Only)

```http
POST /change-requests/{change_request_id}/approve
Content-Type: application/json
Authorization: Bearer {super_admin_token}

{
  "reason": "Approved - Data valid"
}
```

**Response:**

```json
{
    "message": "Change request approved",
    "data": {
        "id": 1,
        "status": "approved",
        "approved_by": 1,
        "approved_at": "2026-07-16T10:05:00"
    }
}
```

### Reject Change Request (Super Admin Only)

```http
POST /change-requests/{change_request_id}/reject
Content-Type: application/json
Authorization: Bearer {super_admin_token}

{
  "reason": "Data tidak sesuai dengan format standar"
}
```

### View Change Request History for Entity

```http
GET /change-requests/history/{entityType}/{entityId}
Authorization: Bearer {token}

Example:
GET /change-requests/history/customer/5
```

---

## 5. INTEGRATION HUB ENDPOINTS

### Receive Customer Update from Integration Hub

```http
POST /integration/customers/update
Content-Type: application/json

{
  "global_id": "CUST-20260716-001",
  "nama": "Updated Name",
  "telepon": "08123456789",
  "alamat": "Updated Address",
  "status": "aktif"
}
```

### Receive Soft Delete from Integration Hub

```http
POST /integration/customers/softdelete
Content-Type: application/json

{
  "global_id": "CUST-20260716-001",
  "status": "deleted"
}
```

### Receive Subscription Update

```http
POST /integration/subscriptions/update
Content-Type: application/json

{
  "global_id": "SUB-20260716-001",
  "global_customer_id": "CUST-20260716-001",
  "paket": "Internet 10 Mbps",
  "harga": 150000,
  "status": "active"
}
```

### Receive Invoice Update

```http
POST /integration/invoices/update
Content-Type: application/json

{
  "global_id": "INV-20260716-001",
  "global_customer_id": "CUST-20260716-001",
  "no_invoice": "INV/2026/001",
  "jumlah": 150000,
  "status": "unpaid"
}
```

### Receive Payment Update

```http
POST /integration/payments/update
Content-Type: application/json

{
  "global_id": "PAY-20260716-001",
  "invoice_id": 1,
  "jumlah": 150000,
  "paid_at": "2026-07-16T15:00:00",
  "status": "paid"
}
```

---

## WORKFLOW EXAMPLES

### Scenario 1: Super Admin Creates Customer (Direct)

```
1. Super Admin POST /customers
   ↓
2. Customer created in database (status: aktif)
   ↓
3. Event sent to Integration Hub immediately
   ↓
4. Response: Customer created successfully
```

### Scenario 2: Admin Creates Customer (Approval Needed)

```
1. Admin POST /customers
   ↓
2. Change Request created (status: pending)
   ↓
3. Response: Awaiting approval
   ↓
4. Super Admin GET /change-requests (sees pending request)
   ↓
5. Super Admin POST /change-requests/{id}/approve
   ↓
6. After approval, customer created + event sent to Hub
```

### Scenario 3: Admin Updates Customer

```
1. Admin PUT /customers/{id}
   ↓
2. Change Request created with old_data & new_data
   ↓
3. Super Admin reviews & approves
   ↓
4. Customer updated + event sent to Hub
```

---

## STATUS CODES

| Code | Meaning                                 |
| ---- | --------------------------------------- |
| 200  | OK - Successful request                 |
| 201  | Created - Resource successfully created |
| 400  | Bad Request - Invalid data              |
| 403  | Forbidden - Unauthorized access         |
| 404  | Not Found - Resource not found          |
| 500  | Server Error                            |

---

## NOTES

1. **Soft Delete**: All deletions use soft delete. Data stays in database but marked as deleted.
2. **Global ID**: Each customer gets a global_id for tracking across apps.
3. **Sync Status**: Customer has sync_status (synced/pending/error) to track Integration Hub sync status.
4. **Approval Workflow**: Only Super Admin can approve changes from Admin users.
5. **Event Emission**: All changes automatically trigger events to Integration Hub.

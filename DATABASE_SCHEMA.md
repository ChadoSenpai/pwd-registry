# PWD Registry Database Schema

## Overview
This document describes the complete database schema for the PWD (Persons with Disabilities) Registry system.

## Entity Relationship Diagram

```
users ──┬── pwd_applications (reviewed_by)
       │
       └── application_documents (verified_by)

provinces ── municipalities ── barangays ── pwd_registrants
                                              │
                                              └── pwd_applications
                                                    │
                                                    └── application_documents

disability_types ── pwd_registrants
```

## Tables

### 1. users
**Purpose:** System user authentication and authorization

| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | bigint | Primary Key, Auto Increment | User ID |
| name | string | - | User name |
| email | string | Unique | User email address |
| email_verified_at | timestamp | Nullable | Email verification timestamp |
| password | string | - | Encrypted password |
| role | string | Default: 'staff' | User role (admin, staff, etc.) |
| remember_token | string | Nullable | Remember me token |
| google2fa_secret | string | Nullable | Google 2FA secret key |
| google2fa_enabled | boolean | Default: false | 2FA enabled status |
| created_at | timestamp | - | Record creation timestamp |
| updated_at | timestamp | - | Record update timestamp |

**Relationships:**
- Has many pwd_applications (reviewed_by)
- Has many application_documents (verified_by)

---

### 2. password_reset_tokens
**Purpose:** Password reset token storage

| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| email | string | Primary Key | User email |
| token | string | - | Reset token |
| created_at | timestamp | Nullable | Token creation timestamp |

---

### 3. sessions
**Purpose:** User session management

| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | string | Primary Key | Session ID |
| user_id | bigint | Foreign Key, Nullable, Indexed | User ID |
| ip_address | string(45) | Nullable | User IP address |
| user_agent | text | Nullable | Browser user agent |
| payload | longText | - | Session data |
| last_activity | integer | Indexed | Last activity timestamp |

---

### 4. provinces
**Purpose:** Geographic province data

| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | bigint | Primary Key, Auto Increment | Province ID |
| code | string(20) | Unique | Province code |
| name | string | - | Province name |
| region_code | string(20) | Nullable | Region code |
| created_at | timestamp | - | Record creation timestamp |
| updated_at | timestamp | - | Record update timestamp |

**Relationships:**
- Has many municipalities

---

### 5. municipalities
**Purpose:** Geographic municipality data

| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | bigint | Primary Key, Auto Increment | Municipality ID |
| code | string(20) | Unique | Municipality code |
| name | string | - | Municipality name |
| province_id | bigint | Foreign Key, Restrict Delete | Province ID |
| created_at | timestamp | - | Record creation timestamp |
| updated_at | timestamp | - | Record update timestamp |

**Relationships:**
- Belongs to province
- Has many barangays

---

### 6. barangays
**Purpose:** Geographic barangay data

| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | bigint | Primary Key, Auto Increment | Barangay ID |
| code | string(20) | Unique | Barangay code |
| name | string | - | Barangay name |
| district | string | Nullable | District name |
| municipality_id | bigint | Foreign Key, Nullable, Restrict Delete | Municipality ID |
| created_at | timestamp | - | Record creation timestamp |
| updated_at | timestamp | - | Record update timestamp |

**Relationships:**
- Belongs to municipality
- Has many pwd_registrants

---

### 7. disability_types
**Purpose:** Disability type classifications

| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | bigint | Primary Key, Auto Increment | Disability type ID |
| code | string(20) | Unique | Disability type code |
| name | string | - | Disability type name |
| description | text | Nullable | Description |
| is_active | boolean | Default: true | Active status |
| created_at | timestamp | - | Record creation timestamp |
| updated_at | timestamp | - | Record update timestamp |

**Relationships:**
- Has many pwd_registrants

---

### 8. pwd_registrants
**Purpose:** PWD registrant information

| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | bigint | Primary Key, Auto Increment | Registrant ID |
| pwd_id_number | string(40) | Unique | PWD ID number |
| first_name | string | - | First name |
| middle_name | string | Nullable | Middle name |
| last_name | string | - | Last name |
| suffix | string(20) | Nullable | Name suffix (Jr, Sr, etc.) |
| birth_date | date | - | Date of birth |
| sex | enum | male, female, prefer_not_to_say | Sex/Gender |
| civil_status | string | Nullable | Civil status |
| address_line | text | - | Complete address |
| contact_number | string(30) | Nullable | Contact number |
| email | string | Nullable | Email address |
| barangay_id | bigint | Foreign Key, Restrict Delete | Barangay ID |
| disability_type_id | bigint | Foreign Key, Restrict Delete | Disability type ID |
| disability_cause | string | Nullable | Cause of disability |
| guardian_name | string | Nullable | Guardian name |
| emergency_contact_name | string | Nullable | Emergency contact name |
| emergency_contact_number | string(30) | Nullable | Emergency contact number |
| photo_path | string | Nullable | Photo file path |
| card_issued_date | date | Nullable | Card issue date |
| card_expiry_date | date | Nullable | Card expiry date |
| card_status | enum | Default: active | Card status (active, expired, suspended, lost) |
| remarks | text | Nullable | Additional remarks |
| created_at | timestamp | - | Record creation timestamp |
| updated_at | timestamp | - | Record update timestamp |

**Indexes:**
- Index on (last_name, first_name)
- Index on card_expiry_date

**Relationships:**
- Belongs to barangay
- Belongs to disability_type
- Has many pwd_applications

---

### 9. pwd_applications
**Purpose:** PWD card applications

| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | bigint | Primary Key, Auto Increment | Application ID |
| pwd_registrant_id | bigint | Foreign Key, Cascade Delete | Registrant ID |
| application_number | string(40) | Unique | Application number |
| type | enum | new, renewal, replacement, update | Application type |
| submitted_at | timestamp | Nullable | Submission timestamp |
| reviewed_at | timestamp | Nullable | Review timestamp |
| approved_at | timestamp | Nullable | Approval timestamp |
| status | enum | Default: draft | Application status (draft, pending, under_review, approved, rejected) |
| reviewed_by | bigint | Foreign Key, Nullable, Null Delete | Reviewer user ID |
| notes | text | Nullable | Review notes |
| created_at | timestamp | - | Record creation timestamp |
| updated_at | timestamp | - | Record update timestamp |
| deleted_at | timestamp | Nullable | Soft delete timestamp |

**Indexes:**
- Index on (status, submitted_at)

**Relationships:**
- Belongs to pwd_registrant
- Belongs to user (reviewed_by)
- Has many application_documents

---

### 10. application_documents
**Purpose:** Document attachments for applications

| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | bigint | Primary Key, Auto Increment | Document ID |
| pwd_application_id | bigint | Foreign Key, Cascade Delete | Application ID |
| document_type | string | - | Document type |
| file_path | string | - | File storage path |
| verified_at | timestamp | Nullable | Verification timestamp |
| verified_by | bigint | Foreign Key, Nullable, Null Delete | Verifier user ID |
| created_at | timestamp | - | Record creation timestamp |
| updated_at | timestamp | - | Record update timestamp |

**Relationships:**
- Belongs to pwd_application
- Belongs to user (verified_by)

---

### 11. jobs
**Purpose:** Laravel queue job storage

| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | bigint | Primary Key, Auto Increment | Job ID |
| queue | string | - | Queue name |
| payload | longText | - | Job payload |
| attempts | tinyInt | - | Number of attempts |
| reserved_at | integer | Nullable | Reservation timestamp |
| available_at | integer | - | Available timestamp |
| created_at | integer | - | Creation timestamp |

---

### 12. job_batches
**Purpose:** Laravel job batch tracking

| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | string | Primary Key | Batch ID |
| name | string | - | Batch name |
| total_jobs | integer | - | Total jobs in batch |
| pending_jobs | integer | - | Pending jobs |
| failed_jobs | integer | - | Failed jobs |
| failed_job_ids | longText | - | Failed job IDs |
| options | mediumText | Nullable | Batch options |
| cancelled_at | integer | Nullable | Cancellation timestamp |
| created_at | integer | - | Creation timestamp |
| finished_at | integer | Nullable | Completion timestamp |

---

### 13. failed_jobs
**Purpose:** Failed job storage

| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| id | bigint | Primary Key, Auto Increment | Failed job ID |
| uuid | string | Unique | Job UUID |
| connection | text | - | Queue connection |
| queue | text | - | Queue name |
| payload | longText | - | Job payload |
| exception | longText | - | Exception message |
| failed_at | timestamp | Default: current | Failure timestamp |

---

### 14. cache
**Purpose:** Laravel cache storage

| Column | Type | Constraints | Description |
|--------|------|------------|-------------|
| key | string | Primary Key | Cache key |
| value | mediumText | - | Cache value |
| expiration | integer | Nullable | Expiration timestamp |

---

## Relationships Summary

### Geographic Hierarchy
- **Province** has many **Municipalities**
- **Municipality** has many **Barangays**
- **Barangay** has many **PWD Registrants**

### PWD Registration Flow
- **PWD Registrant** has many **PWD Applications**
- **PWD Application** has many **Application Documents**
- **PWD Application** belongs to **User** (reviewed_by)
- **Application Document** belongs to **User** (verified_by)

### Classification
- **Disability Type** has many **PWD Registrants**

### User Management
- **User** has many **PWD Applications** (as reviewer)
- **User** has many **Application Documents** (as verifier)

## Indexes

### Performance Indexes
- `users.email` (unique)
- `pwd_registrants.pwd_id_number` (unique)
- `pwd_registrants.last_name, first_name` (composite)
- `pwd_registrants.card_expiry_date`
- `pwd_applications.application_number` (unique)
- `pwd_applications.status, submitted_at` (composite)
- `sessions.user_id`
- `sessions.last_activity`

## Data Integrity

### Foreign Key Constraints
- All foreign keys use `restrictOnDelete()` or `cascadeOnDelete()` to maintain referential integrity
- Geographic hierarchy uses restrict delete to prevent orphan records
- Application-related tables use cascade delete for automatic cleanup

### Enum Values
- `pwd_registrants.sex`: male, female, prefer_not_to_say
- `pwd_registrants.card_status`: active, expired, suspended, lost
- `pwd_applications.type`: new, renewal, replacement, update
- `pwd_applications.status`: draft, pending, under_review, approved, rejected

## Security Features
- Password hashing via Laravel's built-in authentication
- Google 2FA support (google2fa_secret, google2fa_enabled)
- Email verification tracking
- Session management with IP and user agent tracking
- Soft delete support for applications (deleted_at)

## Notes
- Geographic data is currently focused on Laguna Province with 20 municipalities
- Cascading dropdown functionality implemented for province → municipality → barangay selection
- Application workflow supports draft, submission, review, and approval stages
- Document verification workflow with user tracking

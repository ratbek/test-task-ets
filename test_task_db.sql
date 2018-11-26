-- Adminer 4.6.3 PostgreSQL dump

DROP TABLE IF EXISTS "companies";
DROP SEQUENCE IF EXISTS companies_id_seq;
CREATE SEQUENCE companies_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."companies" (
    "id" integer DEFAULT nextval('companies_id_seq') NOT NULL,
    "name" character varying(100) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted" smallint DEFAULT '0' NOT NULL,
    CONSTRAINT "companies_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "companies" ("id", "name", "created_at", "updated_at", "deleted") VALUES
(1,	'Google',	'2018-11-26 14:29:55',	'2018-11-26 14:29:55',	0),
(2,	'SpaceX',	'2018-11-26 14:29:55',	'2018-11-26 14:29:55',	0),
(3,	'Tesla',	'2018-11-26 14:29:55',	'2018-11-26 14:29:55',	0);

DROP TABLE IF EXISTS "company_user";
DROP SEQUENCE IF EXISTS company_user_id_seq;
CREATE SEQUENCE company_user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."company_user" (
    "id" integer DEFAULT nextval('company_user_id_seq') NOT NULL,
    "user_id" integer NOT NULL,
    "company_id" integer NOT NULL,
    CONSTRAINT "company_user_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "company_user_company_id_foreign" FOREIGN KEY (company_id) REFERENCES companies(id) ON UPDATE RESTRICT ON DELETE CASCADE NOT DEFERRABLE,
    CONSTRAINT "company_user_user_id_foreign" FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE RESTRICT ON DELETE CASCADE NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "company_user" ("id", "user_id", "company_id") VALUES
(1,	2,	1),
(2,	3,	1),
(3,	4,	2),
(4,	4,	3);

DROP TABLE IF EXISTS "migrations";
DROP SEQUENCE IF EXISTS migrations_id_seq;
CREATE SEQUENCE migrations_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."migrations" (
    "id" integer DEFAULT nextval('migrations_id_seq') NOT NULL,
    "migration" character varying(255) NOT NULL,
    "batch" integer NOT NULL,
    CONSTRAINT "migrations_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "migrations" ("id", "migration", "batch") VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2016_06_01_000001_create_oauth_auth_codes_table',	1),
(4,	'2016_06_01_000002_create_oauth_access_tokens_table',	1),
(5,	'2016_06_01_000003_create_oauth_refresh_tokens_table',	1),
(6,	'2016_06_01_000004_create_oauth_clients_table',	1),
(7,	'2016_06_01_000005_create_oauth_personal_access_clients_table',	1),
(8,	'2018_11_22_171712_create_companies_table',	1),
(9,	'2018_11_23_061435_create_company_user_table',	1);

DROP TABLE IF EXISTS "oauth_access_tokens";
CREATE TABLE "public"."oauth_access_tokens" (
    "id" character varying(100) NOT NULL,
    "user_id" integer,
    "client_id" integer NOT NULL,
    "name" character varying(255),
    "scopes" text,
    "revoked" boolean NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "expires_at" timestamp(0),
    CONSTRAINT "oauth_access_tokens_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "oauth_access_tokens_user_id_index" ON "public"."oauth_access_tokens" USING btree ("user_id");


DROP TABLE IF EXISTS "oauth_auth_codes";
CREATE TABLE "public"."oauth_auth_codes" (
    "id" character varying(100) NOT NULL,
    "user_id" integer NOT NULL,
    "client_id" integer NOT NULL,
    "scopes" text,
    "revoked" boolean NOT NULL,
    "expires_at" timestamp(0),
    CONSTRAINT "oauth_auth_codes_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "oauth_clients";
DROP SEQUENCE IF EXISTS oauth_clients_id_seq;
CREATE SEQUENCE oauth_clients_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."oauth_clients" (
    "id" integer DEFAULT nextval('oauth_clients_id_seq') NOT NULL,
    "user_id" integer,
    "name" character varying(255) NOT NULL,
    "secret" character varying(100) NOT NULL,
    "redirect" text NOT NULL,
    "personal_access_client" boolean NOT NULL,
    "password_client" boolean NOT NULL,
    "revoked" boolean NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "oauth_clients_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "oauth_clients_user_id_index" ON "public"."oauth_clients" USING btree ("user_id");


DROP TABLE IF EXISTS "oauth_personal_access_clients";
DROP SEQUENCE IF EXISTS oauth_personal_access_clients_id_seq;
CREATE SEQUENCE oauth_personal_access_clients_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."oauth_personal_access_clients" (
    "id" integer DEFAULT nextval('oauth_personal_access_clients_id_seq') NOT NULL,
    "client_id" integer NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "oauth_personal_access_clients_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "oauth_personal_access_clients_client_id_index" ON "public"."oauth_personal_access_clients" USING btree ("client_id");


DROP TABLE IF EXISTS "oauth_refresh_tokens";
CREATE TABLE "public"."oauth_refresh_tokens" (
    "id" character varying(100) NOT NULL,
    "access_token_id" character varying(100) NOT NULL,
    "revoked" boolean NOT NULL,
    "expires_at" timestamp(0),
    CONSTRAINT "oauth_refresh_tokens_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

CREATE INDEX "oauth_refresh_tokens_access_token_id_index" ON "public"."oauth_refresh_tokens" USING btree ("access_token_id");


DROP TABLE IF EXISTS "password_resets";
CREATE TABLE "public"."password_resets" (
    "email" character varying(255) NOT NULL,
    "token" character varying(255) NOT NULL,
    "created_at" timestamp(0)
) WITH (oids = false);

CREATE INDEX "password_resets_email_index" ON "public"."password_resets" USING btree ("email");


DROP TABLE IF EXISTS "users";
DROP SEQUENCE IF EXISTS users_id_seq;
CREATE SEQUENCE users_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 START 1 CACHE 1;

CREATE TABLE "public"."users" (
    "id" integer DEFAULT nextval('users_id_seq') NOT NULL,
    "username" character varying(100) NOT NULL,
    "first_name" character varying(100),
    "last_name" character varying(100),
    "email" character varying(100) NOT NULL,
    "password" character varying(255) NOT NULL,
    "remember_token" character varying(100),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted" smallint DEFAULT '0' NOT NULL,
    CONSTRAINT "users_email_unique" UNIQUE ("email"),
    CONSTRAINT "users_pkey" PRIMARY KEY ("id"),
    CONSTRAINT "users_username_unique" UNIQUE ("username")
) WITH (oids = false);

INSERT INTO "users" ("id", "username", "first_name", "last_name", "email", "password", "remember_token", "created_at", "updated_at", "deleted") VALUES
(1,	'admin',	'Admin',	'Adminov',	'admin@mail.com',	'$2y$10$QRAm2Q8k73oYj3Z5bKSz4ucob.5DqgqV0E1Nl3h1IU/ke5ERlXhyi',	NULL,	'2018-11-26 14:31:09',	'2018-11-26 14:31:09',	0),
(2,	'sergey',	'Sergey',	'Brin',	'brin@gmail.com',	'$2y$10$LXt8ijQQINJjuouh1DWa1e6fPzzmALPqbo.wJgUR9ErhfpBlmd3Om',	NULL,	'2018-11-26 14:31:09',	'2018-11-26 14:31:09',	0),
(3,	'larry',	'Larry',	'Page',	'lary@gmail.com',	'$2y$10$wPNLoCYijaXwMGunZy5PietqZZeAWBh8oF3qCv9pR2n0JsLSKPGKy',	NULL,	'2018-11-26 14:31:09',	'2018-11-26 14:31:09',	0),
(4,	'elon',	'Elon',	'Musk',	'elon@mail.com',	'$2y$10$JNUkRNuplFxCdqr57lFC6uM5jDUzxc6Na2FlcVaZLlzDLrxolOnk6',	NULL,	'2018-11-26 14:31:09',	'2018-11-26 14:31:09',	0);

-- 2018-11-26 20:53:43.438916+06

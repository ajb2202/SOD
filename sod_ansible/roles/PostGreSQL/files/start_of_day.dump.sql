--
-- PostgreSQL database dump
--

-- Dumped from database version 10.9
-- Dumped by pg_dump version 10.9

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner:
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner:
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: sod; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sod (
    uptime character varying(60),
    nicdown character varying(60),
    nicbond character varying(60),
    nicduplex character varying(60),
    cpu character varying(60),
    disk character varying(60),
    power character varying(60),
    hardware character varying(60),
    fans character varying(60),
    perc character varying(60),
    memory character varying(60),
    cron character varying(60),
    "time" character varying(60),
    timestat character varying(60),
    hba character varying(60),
    luns character varying(60),
    date timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    host character varying(90),
    battery character varying(60),
    cstate character varying(60),
    lockfile character varying(60),
    nicswitch character varying(60),
    percbattery character varying(60),
    stale character varying(60),
    nicbonddown character varying(500),
    os character varying(40),
    tanium character varying(40),
    hids character varying(40),
    mon character varying(40),
    maxcstate character varying(40)
);


ALTER TABLE public.sod OWNER TO postgres;

--
-- PostgreSQL database dump complete
--

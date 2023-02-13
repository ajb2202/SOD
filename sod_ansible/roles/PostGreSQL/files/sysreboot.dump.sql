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
-- Name: reboot_status; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reboot_status (
    host character varying(20),
    status character varying(20),
    bootstart character varying(35),
    cpu character varying(30),
    mem character varying(30),
    swap character varying(30),
    pci character varying(30),
    disk character varying(30),
    netstat character varying(30),
    kernel character varying(30),
    kernelboot character varying(30),
    mount character varying(30),
    nic character varying(30),
    schd character varying(35),
    uptime character varying(35),
    cpuout character varying(600),
    pciout character varying(600),
    swapout character varying(600),
    nicout character varying(600),
    diskout character varying(600),
    netstatout character varying(600),
    mountout character varying(600),
    memout character varying(600),
    kernelout character varying(600),
    kernelbootout character varying(600),
    ntpoffset character varying(30),
    ntpoffsetout character varying(30),
    ntppeer character varying(30),
    ntppeerout character varying(30),
    sa character varying(600),
    htout character varying(600),
    ht character varying(600),
    powerout character varying(600),
    power character varying(600),
    idrac character varying(300),
    bios character varying(600),
    biosout character varying(600),
    nicbonddown character varying(600),
    nicbonddownout character varying(600),
    nicbond character varying(600),
    nicbondout character varying(600),
    nicduplex character varying(600),
    nicduplexout character varying(600)
);


ALTER TABLE public.reboot_status OWNER TO postgres;

--
-- PostgreSQL database dump complete
--

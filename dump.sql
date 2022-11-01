--
-- PostgreSQL database dump
--

-- Dumped from database version 12.10
-- Dumped by pg_dump version 12.6

-- Started on 2022-11-01 15:27:47 +07

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 203 (class 1259 OID 33675)
-- Name: role; Type: TABLE; Schema: public; Owner: sibers
--

CREATE TABLE public.role (
    id bigint NOT NULL,
    keyword character varying(50) NOT NULL
);


ALTER TABLE public.role OWNER TO sibers;

--
-- TOC entry 202 (class 1259 OID 33673)
-- Name: role_id_seq; Type: SEQUENCE; Schema: public; Owner: sibers
--

CREATE SEQUENCE public.role_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.role_id_seq OWNER TO sibers;

--
-- TOC entry 3156 (class 0 OID 0)
-- Dependencies: 202
-- Name: role_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sibers
--

ALTER SEQUENCE public.role_id_seq OWNED BY public.role.id;


--
-- TOC entry 205 (class 1259 OID 33685)
-- Name: users; Type: TABLE; Schema: public; Owner: sibers
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    login character varying(50) NOT NULL,
    password character varying(50) NOT NULL,
    name character varying(50) NOT NULL,
    last_name character varying(50) NOT NULL,
    gender character varying(50) NOT NULL,
    birthday date NOT NULL,
    role_id integer
);


ALTER TABLE public.users OWNER TO sibers;

--
-- TOC entry 204 (class 1259 OID 33683)
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: sibers
--

CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO sibers;

--
-- TOC entry 3157 (class 0 OID 0)
-- Dependencies: 204
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: sibers
--

ALTER SEQUENCE public.user_id_seq OWNED BY public.users.id;


--
-- TOC entry 3010 (class 2604 OID 33678)
-- Name: role id; Type: DEFAULT; Schema: public; Owner: sibers
--

ALTER TABLE ONLY public.role ALTER COLUMN id SET DEFAULT nextval('public.role_id_seq'::regclass);


--
-- TOC entry 3011 (class 2604 OID 33688)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: sibers
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- TOC entry 3148 (class 0 OID 33675)
-- Dependencies: 203
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: sibers
--

INSERT INTO public.role (id, keyword) VALUES (1, 'admin');
INSERT INTO public.role (id, keyword) VALUES (3, 'default_user');


--
-- TOC entry 3150 (class 0 OID 33685)
-- Dependencies: 205
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: sibers
--

INSERT INTO public.users (id, login, password, name, last_name, gender, birthday, role_id) VALUES (14, 'admin', 'admin', 'admin', 'admin', 'admin', '2000-04-20', 1);
INSERT INTO public.users (id, login, password, name, last_name, gender, birthday, role_id) VALUES (15, 'admin1', 'admin', 'admin', 'admin', 'admin', '2022-10-01', 1);
INSERT INTO public.users (id, login, password, name, last_name, gender, birthday, role_id) VALUES (13, 'vano4', 'vano', 'vano', 'vostrik', 'gigachad', '2000-04-20', 3);
INSERT INTO public.users (id, login, password, name, last_name, gender, birthday, role_id) VALUES (16, 'vano1', 'vano', 'vano', 'vano', 'vano', '2000-04-20', 3);
INSERT INTO public.users (id, login, password, name, last_name, gender, birthday, role_id) VALUES (18, 'vano3', 'vano', 'vano', 'vano', 'vano', '2000-04-20', 3);
INSERT INTO public.users (id, login, password, name, last_name, gender, birthday, role_id) VALUES (19, 'vano5', 'vano', 'vano', 'vano', 'vano', '2000-04-20', 3);
INSERT INTO public.users (id, login, password, name, last_name, gender, birthday, role_id) VALUES (20, 'vano6', 'vano', 'vano', 'vano', 'vano', '2000-04-20', 3);
INSERT INTO public.users (id, login, password, name, last_name, gender, birthday, role_id) VALUES (21, 'vano7', 'vano', 'vano', 'vano', 'vano', '2000-04-20', 3);
INSERT INTO public.users (id, login, password, name, last_name, gender, birthday, role_id) VALUES (22, 'vano8', 'vano', 'vano', 'vano', 'vano', '2000-04-20', 3);
INSERT INTO public.users (id, login, password, name, last_name, gender, birthday, role_id) VALUES (24, 'vano10', 'vano', 'vano', 'vano', 'vano', '2000-04-20', 3);
INSERT INTO public.users (id, login, password, name, last_name, gender, birthday, role_id) VALUES (25, 'vano15', 'asd222', 'asd', 'asd', 'asd', '2022-11-01', 3);


--
-- TOC entry 3158 (class 0 OID 0)
-- Dependencies: 202
-- Name: role_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sibers
--

SELECT pg_catalog.setval('public.role_id_seq', 3, true);


--
-- TOC entry 3159 (class 0 OID 0)
-- Dependencies: 204
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: sibers
--

SELECT pg_catalog.setval('public.user_id_seq', 25, true);


--
-- TOC entry 3013 (class 2606 OID 33680)
-- Name: role role_pkey; Type: CONSTRAINT; Schema: public; Owner: sibers
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_pkey PRIMARY KEY (id);


--
-- TOC entry 3015 (class 2606 OID 33682)
-- Name: role unique_keyword; Type: CONSTRAINT; Schema: public; Owner: sibers
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT unique_keyword UNIQUE (keyword);


--
-- TOC entry 3017 (class 2606 OID 33692)
-- Name: users unique_login; Type: CONSTRAINT; Schema: public; Owner: sibers
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT unique_login UNIQUE (login);


--
-- TOC entry 3019 (class 2606 OID 33690)
-- Name: users user_pkey; Type: CONSTRAINT; Schema: public; Owner: sibers
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- TOC entry 3020 (class 2606 OID 33693)
-- Name: users fk_tests_students; Type: FK CONSTRAINT; Schema: public; Owner: sibers
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT fk_tests_students FOREIGN KEY (role_id) REFERENCES public.role(id);


-- Completed on 2022-11-01 15:27:48 +07

--
-- PostgreSQL database dump complete
--


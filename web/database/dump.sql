--
-- PostgreSQL database dump
--

-- Dumped from database version 11.2 (Ubuntu 11.2-1.pgdg16.04+1)
-- Dumped by pg_dump version 11.2 (Ubuntu 11.2-1.pgdg16.04+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: cabinets; Type: TABLE; Schema: public; Owner: argus
--

CREATE TABLE public.cabinets (
    id integer NOT NULL,
    name character(255) NOT NULL,
    camera_address inet
);


ALTER TABLE public.cabinets OWNER TO argus;

--
-- Name: Cabinets_id_seq; Type: SEQUENCE; Schema: public; Owner: argus
--

CREATE SEQUENCE public."Cabinets_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Cabinets_id_seq" OWNER TO argus;

--
-- Name: Cabinets_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: argus
--

ALTER SEQUENCE public."Cabinets_id_seq" OWNED BY public.cabinets.id;


--
-- Name: Groups; Type: TABLE; Schema: public; Owner: argus
--

CREATE TABLE public."Groups" (
    id integer NOT NULL,
    name character(255) NOT NULL
);


ALTER TABLE public."Groups" OWNER TO argus;

--
-- Name: Groups_id_seq; Type: SEQUENCE; Schema: public; Owner: argus
--

CREATE SEQUENCE public."Groups_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Groups_id_seq" OWNER TO argus;

--
-- Name: Groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: argus
--

ALTER SEQUENCE public."Groups_id_seq" OWNED BY public."Groups".id;


--
-- Name: Students; Type: TABLE; Schema: public; Owner: argus
--

CREATE TABLE public."Students" (
    id integer NOT NULL,
    sn character(255) NOT NULL,
    fn character(255) NOT NULL,
    pt character(255) NOT NULL,
    group_id integer NOT NULL
);


ALTER TABLE public."Students" OWNER TO argus;

--
-- Name: Students_id_seq; Type: SEQUENCE; Schema: public; Owner: argus
--

CREATE SEQUENCE public."Students_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Students_id_seq" OWNER TO argus;

--
-- Name: Students_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: argus
--

ALTER SEQUENCE public."Students_id_seq" OWNED BY public."Students".id;


--
-- Name: faces_journal; Type: TABLE; Schema: public; Owner: argus
--

CREATE TABLE public.faces_journal (
    " face_id" integer NOT NULL,
    student_id integer NOT NULL,
    encoding bytea NOT NULL,
    picture_link text NOT NULL
);


ALTER TABLE public.faces_journal OWNER TO argus;

--
-- Name: faces_journal_ face_id_seq; Type: SEQUENCE; Schema: public; Owner: argus
--

CREATE SEQUENCE public."faces_journal_ face_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."faces_journal_ face_id_seq" OWNER TO argus;

--
-- Name: faces_journal_ face_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: argus
--

ALTER SEQUENCE public."faces_journal_ face_id_seq" OWNED BY public.faces_journal." face_id";


--
-- Name: mephi_journal; Type: TABLE; Schema: public; Owner: argus
--

CREATE TABLE public.mephi_journal (
    id integer NOT NULL,
    cabinet_id integer NOT NULL,
    student_id integer NOT NULL,
    date date NOT NULL,
    para_num integer NOT NULL
);


ALTER TABLE public.mephi_journal OWNER TO argus;

--
-- Name: mephi_journal_id_seq; Type: SEQUENCE; Schema: public; Owner: argus
--

CREATE SEQUENCE public.mephi_journal_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.mephi_journal_id_seq OWNER TO argus;

--
-- Name: mephi_journal_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: argus
--

ALTER SEQUENCE public.mephi_journal_id_seq OWNED BY public.mephi_journal.id;


--
-- Name: Groups id; Type: DEFAULT; Schema: public; Owner: argus
--

ALTER TABLE ONLY public."Groups" ALTER COLUMN id SET DEFAULT nextval('public."Groups_id_seq"'::regclass);


--
-- Name: Students id; Type: DEFAULT; Schema: public; Owner: argus
--

ALTER TABLE ONLY public."Students" ALTER COLUMN id SET DEFAULT nextval('public."Students_id_seq"'::regclass);


--
-- Name: cabinets id; Type: DEFAULT; Schema: public; Owner: argus
--

ALTER TABLE ONLY public.cabinets ALTER COLUMN id SET DEFAULT nextval('public."Cabinets_id_seq"'::regclass);


--
-- Name: faces_journal  face_id; Type: DEFAULT; Schema: public; Owner: argus
--

ALTER TABLE ONLY public.faces_journal ALTER COLUMN " face_id" SET DEFAULT nextval('public."faces_journal_ face_id_seq"'::regclass);


--
-- Name: mephi_journal id; Type: DEFAULT; Schema: public; Owner: argus
--

ALTER TABLE ONLY public.mephi_journal ALTER COLUMN id SET DEFAULT nextval('public.mephi_journal_id_seq'::regclass);


--
-- Data for Name: Groups; Type: TABLE DATA; Schema: public; Owner: argus
--

COPY public."Groups" (id, name) FROM stdin;
\.


--
-- Data for Name: Students; Type: TABLE DATA; Schema: public; Owner: argus
--

COPY public."Students" (id, sn, fn, pt, group_id) FROM stdin;
\.


--
-- Data for Name: cabinets; Type: TABLE DATA; Schema: public; Owner: argus
--

COPY public.cabinets (id, name, camera_address) FROM stdin;
1	A-101                                                                                                                                                                                                                                                          	213.24.32.15
2	A-102                                                                                                                                                                                                                                                          	213.24.32.16
\.


--
-- Data for Name: faces_journal; Type: TABLE DATA; Schema: public; Owner: argus
--

COPY public.faces_journal (" face_id", student_id, encoding, picture_link) FROM stdin;
\.


--
-- Data for Name: mephi_journal; Type: TABLE DATA; Schema: public; Owner: argus
--

COPY public.mephi_journal (id, cabinet_id, student_id, date, para_num) FROM stdin;
2	30	20	2005-01-01	3
4	31	20	2006-01-01	3
5	31	20	2006-01-01	3
6	31	20	2006-01-01	3
\.


--
-- Name: Cabinets_id_seq; Type: SEQUENCE SET; Schema: public; Owner: argus
--

SELECT pg_catalog.setval('public."Cabinets_id_seq"', 2, true);


--
-- Name: Groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: argus
--

SELECT pg_catalog.setval('public."Groups_id_seq"', 1, false);


--
-- Name: Students_id_seq; Type: SEQUENCE SET; Schema: public; Owner: argus
--

SELECT pg_catalog.setval('public."Students_id_seq"', 1, false);


--
-- Name: faces_journal_ face_id_seq; Type: SEQUENCE SET; Schema: public; Owner: argus
--

SELECT pg_catalog.setval('public."faces_journal_ face_id_seq"', 1, false);


--
-- Name: mephi_journal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: argus
--

SELECT pg_catalog.setval('public.mephi_journal_id_seq', 6, true);


--
-- Name: cabinets PK_Cabinets_1; Type: CONSTRAINT; Schema: public; Owner: argus
--

ALTER TABLE ONLY public.cabinets
    ADD CONSTRAINT "PK_Cabinets_1" PRIMARY KEY (id);


--
-- Name: Groups PK_Groups_1; Type: CONSTRAINT; Schema: public; Owner: argus
--

ALTER TABLE ONLY public."Groups"
    ADD CONSTRAINT "PK_Groups_1" PRIMARY KEY (id);


--
-- Name: Students PK_Students_1; Type: CONSTRAINT; Schema: public; Owner: argus
--

ALTER TABLE ONLY public."Students"
    ADD CONSTRAINT "PK_Students_1" PRIMARY KEY (id);


--
-- Name: faces_journal PK_Table_1_1; Type: CONSTRAINT; Schema: public; Owner: argus
--

ALTER TABLE ONLY public.faces_journal
    ADD CONSTRAINT "PK_Table_1_1" PRIMARY KEY (" face_id");


--
-- Name: mephi_journal PK_mephi_journal_1; Type: CONSTRAINT; Schema: public; Owner: argus
--

ALTER TABLE ONLY public.mephi_journal
    ADD CONSTRAINT "PK_mephi_journal_1" PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--


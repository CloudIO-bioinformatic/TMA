--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.13
-- Dumped by pg_dump version 9.5.13

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
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
-- Name: invita; Type: TABLE; Schema: public; Owner: reunion
--

CREATE TABLE public.invita (
    user_name character varying(100) NOT NULL,
    id_reunion integer NOT NULL,
    asiste boolean
);


ALTER TABLE public.invita OWNER TO reunion;

--
-- Name: reunion; Type: TABLE; Schema: public; Owner: reunion
--

CREATE TABLE public.reunion (
    id_reunion integer NOT NULL,
    user_name character varying(100) NOT NULL,
    usu_user_name character varying(100) NOT NULL,
    fecha_creacion date NOT NULL,
    aprobada boolean NOT NULL,
    fecha_aprobada date,
    fecha_reunion date NOT NULL,
    hora_reunion time without time zone,
    ruta_documento character varying(1500)
);


ALTER TABLE public.reunion OWNER TO reunion;

--
-- Name: reunion_id_reunion_seq; Type: SEQUENCE; Schema: public; Owner: reunion
--

CREATE SEQUENCE public.reunion_id_reunion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reunion_id_reunion_seq OWNER TO reunion;

--
-- Name: reunion_id_reunion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: reunion
--

ALTER SEQUENCE public.reunion_id_reunion_seq OWNED BY public.reunion.id_reunion;


--
-- Name: tema; Type: TABLE; Schema: public; Owner: reunion
--

CREATE TABLE public.tema (
    id_tema integer NOT NULL,
    id_reunion integer NOT NULL,
    descripcion character varying(1500) NOT NULL,
    ruta_archivo character varying(1000),
    comentario_tema character varying(1500)
);


ALTER TABLE public.tema OWNER TO reunion;

--
-- Name: tema_id_tema_seq; Type: SEQUENCE; Schema: public; Owner: reunion
--

CREATE SEQUENCE public.tema_id_tema_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tema_id_tema_seq OWNER TO reunion;

--
-- Name: tema_id_tema_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: reunion
--

ALTER SEQUENCE public.tema_id_tema_seq OWNED BY public.tema.id_tema;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: reunion
--

CREATE TABLE public.usuario (
    user_name character varying(100) NOT NULL,
    nombres character varying(150) NOT NULL,
    apellidos character varying(150) NOT NULL,
    correo character varying(150) NOT NULL,
    contrasena character varying(1000) NOT NULL,
    celular character varying(25) NOT NULL,
    director boolean NOT NULL,
    admin boolean NOT NULL,
    secretario boolean NOT NULL
);


ALTER TABLE public.usuario OWNER TO reunion;

--
-- Name: votacion; Type: TABLE; Schema: public; Owner: reunion
--

CREATE TABLE public.votacion (
    user_name character varying(100) NOT NULL,
    id_tema integer NOT NULL,
    voto boolean,
    fecha_creacion date,
    comentario character varying(700)
);


ALTER TABLE public.votacion OWNER TO reunion;

--
-- Name: id_reunion; Type: DEFAULT; Schema: public; Owner: reunion
--

ALTER TABLE ONLY public.reunion ALTER COLUMN id_reunion SET DEFAULT nextval('public.reunion_id_reunion_seq'::regclass);


--
-- Name: id_tema; Type: DEFAULT; Schema: public; Owner: reunion
--

ALTER TABLE ONLY public.tema ALTER COLUMN id_tema SET DEFAULT nextval('public.tema_id_tema_seq'::regclass);


--
-- Data for Name: invita; Type: TABLE DATA; Schema: public; Owner: reunion
--

COPY public.invita (user_name, id_reunion, asiste) FROM stdin;
gnunez	18	\N
wgonzalez	18	\N
jcaballero	18	\N
griadi	18	\N
idreyer	18	\N
jreyes	18	\N
fduran	18	\N
avaldes	18	\N
jalzate	18	\N
marenas	18	\N
admin	18	\N
\.


--
-- Data for Name: reunion; Type: TABLE DATA; Schema: public; Owner: reunion
--

COPY public.reunion (id_reunion, user_name, usu_user_name, fecha_creacion, aprobada, fecha_aprobada, fecha_reunion, hora_reunion, ruta_documento) FROM stdin;
18	gnunez	avaldes	2018-08-12	f	\N	2018-08-10	19:40:00	../uploads/2018-08-12_Descripción_Informe2_Grupo7_1.pdf
\.


--
-- Name: reunion_id_reunion_seq; Type: SEQUENCE SET; Schema: public; Owner: reunion
--

SELECT pg_catalog.setval('public.reunion_id_reunion_seq', 18, true);


--
-- Data for Name: tema; Type: TABLE DATA; Schema: public; Owner: reunion
--

COPY public.tema (id_tema, id_reunion, descripcion, ruta_archivo, comentario_tema) FROM stdin;
21	18	tema 3	\N	\N
22	18	tema 4	\N	\N
19	18	tema 1	\N	\N
20	18	tema 2	\N	\N
\.


--
-- Name: tema_id_tema_seq; Type: SEQUENCE SET; Schema: public; Owner: reunion
--

SELECT pg_catalog.setval('public.tema_id_tema_seq', 22, true);


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: reunion
--

COPY public.usuario (user_name, nombres, apellidos, correo, contrasena, celular, director, admin, secretario) FROM stdin;
admin	admin	admin	admin@admin.admin	zTxaYEBSLDpgQVyN3NiMYFIw5yRf/JZBIEn8EAJy2R0=	sin numero	f	t	f
fduran	Fabio	Durán	fduran@utalca.cl	zTxaYEBSLDpgQVyN3NiMYFIw5yRf/JZBIEn8EAJy2R0=	sin número	f	f	f
gnunez	Gabriel	Nuñez	gnunez@utalca.cl	zTxaYEBSLDpgQVyN3NiMYFIw5yRf/JZBIEn8EAJy2R0=	sin número	t	f	f
griadi	Gonzalo	Riadi	griadi@utalca.cl	zTxaYEBSLDpgQVyN3NiMYFIw5yRf/JZBIEn8EAJy2R0=	071 2 - 201671	f	f	f
idreyer	Ingo	Dreyer	idreyer@utalca.cl	zTxaYEBSLDpgQVyN3NiMYFIw5yRf/JZBIEn8EAJy2R0=	sin número	f	f	f
jalzate	Jans	Alzate	jalzate@utalca.cl	zTxaYEBSLDpgQVyN3NiMYFIw5yRf/JZBIEn8EAJy2R0=	sin número	f	f	f
jreyes	José	Reyes	jreyes@utalca.cl	zTxaYEBSLDpgQVyN3NiMYFIw5yRf/JZBIEn8EAJy2R0=	071 2 - 201658	f	f	f
jcaballero	Julio	Caballero	jcaballero@utalca.cl	zTxaYEBSLDpgQVyN3NiMYFIw5yRf/JZBIEn8EAJy2R0=	071 2 - 418850 	f	f	f
marenas	Mauricio	Arenas	marenas@utalca.cl	zTxaYEBSLDpgQVyN3NiMYFIw5yRf/JZBIEn8EAJy2R0=	071 2 - 201660	f	f	f
wgonzalez	Wendy	Gonzalez	wgonzalez@utalca.cl	zTxaYEBSLDpgQVyN3NiMYFIw5yRf/JZBIEn8EAJy2R0=	071 2 - 201674	f	f	f
ypena	Yasna	Pena	ypena@utalca.cl	zTxaYEBSLDpgQVyN3NiMYFIw5yRf/JZBIEn8EAJy2R0=	071 - 201685	f	f	f
avaldes	Alejandro	Valdés	avaldes@utalca.cl	zTxaYEBSLDpgQVyN3NiMYFIw5yRf/JZBIEn8EAJy2R0=	sin número	f	f	t
\.


--
-- Data for Name: votacion; Type: TABLE DATA; Schema: public; Owner: reunion
--

COPY public.votacion (user_name, id_tema, voto, fecha_creacion, comentario) FROM stdin;
gnunez	19	f	2018-08-12	comentari
gnunez	20	t	2018-08-12	comentarioiioio
\.


--
-- Name: pk_invita; Type: CONSTRAINT; Schema: public; Owner: reunion
--

ALTER TABLE ONLY public.invita
    ADD CONSTRAINT pk_invita PRIMARY KEY (user_name, id_reunion);


--
-- Name: pk_reunion; Type: CONSTRAINT; Schema: public; Owner: reunion
--

ALTER TABLE ONLY public.reunion
    ADD CONSTRAINT pk_reunion PRIMARY KEY (id_reunion);


--
-- Name: pk_tema; Type: CONSTRAINT; Schema: public; Owner: reunion
--

ALTER TABLE ONLY public.tema
    ADD CONSTRAINT pk_tema PRIMARY KEY (id_tema);


--
-- Name: pk_usuario; Type: CONSTRAINT; Schema: public; Owner: reunion
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT pk_usuario PRIMARY KEY (user_name);


--
-- Name: pk_votacion; Type: CONSTRAINT; Schema: public; Owner: reunion
--

ALTER TABLE ONLY public.votacion
    ADD CONSTRAINT pk_votacion PRIMARY KEY (user_name, id_tema);


--
-- Name: director_crea_fk; Type: INDEX; Schema: public; Owner: reunion
--

CREATE INDEX director_crea_fk ON public.reunion USING btree (user_name);


--
-- Name: es_secretario_en_fk; Type: INDEX; Schema: public; Owner: reunion
--

CREATE INDEX es_secretario_en_fk ON public.reunion USING btree (usu_user_name);


--
-- Name: invita2_fk; Type: INDEX; Schema: public; Owner: reunion
--

CREATE INDEX invita2_fk ON public.invita USING btree (id_reunion);


--
-- Name: invita_fk; Type: INDEX; Schema: public; Owner: reunion
--

CREATE INDEX invita_fk ON public.invita USING btree (user_name);


--
-- Name: invita_pk; Type: INDEX; Schema: public; Owner: reunion
--

CREATE UNIQUE INDEX invita_pk ON public.invita USING btree (user_name, id_reunion);


--
-- Name: reunion_pk; Type: INDEX; Schema: public; Owner: reunion
--

CREATE UNIQUE INDEX reunion_pk ON public.reunion USING btree (id_reunion);


--
-- Name: tema_pk; Type: INDEX; Schema: public; Owner: reunion
--

CREATE UNIQUE INDEX tema_pk ON public.tema USING btree (id_tema);


--
-- Name: tiene_fk; Type: INDEX; Schema: public; Owner: reunion
--

CREATE INDEX tiene_fk ON public.tema USING btree (id_reunion);


--
-- Name: usuario_pk; Type: INDEX; Schema: public; Owner: reunion
--

CREATE UNIQUE INDEX usuario_pk ON public.usuario USING btree (user_name);


--
-- Name: votacion2_fk; Type: INDEX; Schema: public; Owner: reunion
--

CREATE INDEX votacion2_fk ON public.votacion USING btree (id_tema);


--
-- Name: votacion_fk; Type: INDEX; Schema: public; Owner: reunion
--

CREATE INDEX votacion_fk ON public.votacion USING btree (user_name);


--
-- Name: votacion_pk; Type: INDEX; Schema: public; Owner: reunion
--

CREATE UNIQUE INDEX votacion_pk ON public.votacion USING btree (user_name, id_tema);


--
-- Name: fk_invita_invita2_reunion; Type: FK CONSTRAINT; Schema: public; Owner: reunion
--

ALTER TABLE ONLY public.invita
    ADD CONSTRAINT fk_invita_invita2_reunion FOREIGN KEY (id_reunion) REFERENCES public.reunion(id_reunion) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_invita_invita_usuario; Type: FK CONSTRAINT; Schema: public; Owner: reunion
--

ALTER TABLE ONLY public.invita
    ADD CONSTRAINT fk_invita_invita_usuario FOREIGN KEY (user_name) REFERENCES public.usuario(user_name) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_reunion_director__usuario; Type: FK CONSTRAINT; Schema: public; Owner: reunion
--

ALTER TABLE ONLY public.reunion
    ADD CONSTRAINT fk_reunion_director__usuario FOREIGN KEY (user_name) REFERENCES public.usuario(user_name) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_reunion_es_secret_usuario; Type: FK CONSTRAINT; Schema: public; Owner: reunion
--

ALTER TABLE ONLY public.reunion
    ADD CONSTRAINT fk_reunion_es_secret_usuario FOREIGN KEY (usu_user_name) REFERENCES public.usuario(user_name) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_tema_tiene_reunion; Type: FK CONSTRAINT; Schema: public; Owner: reunion
--

ALTER TABLE ONLY public.tema
    ADD CONSTRAINT fk_tema_tiene_reunion FOREIGN KEY (id_reunion) REFERENCES public.reunion(id_reunion) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_votacion_votacion2_tema; Type: FK CONSTRAINT; Schema: public; Owner: reunion
--

ALTER TABLE ONLY public.votacion
    ADD CONSTRAINT fk_votacion_votacion2_tema FOREIGN KEY (id_tema) REFERENCES public.tema(id_tema) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_votacion_votacion_usuario; Type: FK CONSTRAINT; Schema: public; Owner: reunion
--

ALTER TABLE ONLY public.votacion
    ADD CONSTRAINT fk_votacion_votacion_usuario FOREIGN KEY (user_name) REFERENCES public.usuario(user_name) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--


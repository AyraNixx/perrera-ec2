/*			INSERT ROLES		*/
INSERT INTO `perrera`.roles (rol, descripcion) VALUES ('Administrador', 'Acceso a todas las tablas y funciones disponibles'),
													  ('Encargado de Adopciones', 'Gestiona los procesos de adopción, acceso a las tablas relacionadas con animales, dueños y adoptantes'),
													  ('Encargado de Tareas', 'Responsable de la gestión de tareas, puede añadir, eliminar y modificar tareas así como de asignarlas a los empleados y voluntarios'),
													  ('Encargado de Voluntarios', 'Responsable de la gestión de tareas de la asignación y/o modificación de tareas para los voluntarios'),
													  ('Empleado', 'Acceso a las tablas relacionadas con los animales y la asignación de tareas, funciones más limitadas');
                                                      
                                                      
/*			INSERT ESPECIES			*/                                                      
INSERT INTO `perrera`.`especies` (`id`,`nombre`, `descripcion`) VALUES ('00B100292511104237965', 'Perro', 'Animal doméstico que pertenece a la familia Canidae.'),
																  ('00B100292511104237966', 'Gato', 'Animal doméstico que pertenece a la familia Felidae.'),
																  ('00B100292511104237967', 'Conejo', 'Animal que pertenece a la familia Leporidae.'),
																  ('00B100292511104237968', 'Pájaro', 'Animal que pertenece a la clase Aves.'),
                                                                  ('00B100292511104237969', 'Otros', 'Especie no especificada o no común en la perrera.');
                                                                  
                                                                  INSERT INTO `perrera`.`especies` (`nombre`, `descripcion`) VALUES ('prueba', 'Animal doméstico que pertenece a la familia Canidae.');


/*			INSERT JAULAS			*/  
/*Tamanio hace referencia al número de perros que entran dentro*/
INSERT INTO `perrera`.`jaulas` (`ubicacion`, `tamanio`, `ocupada`, `estado_comida`, `estado_limpieza`, `descripcion`, `especies_id`)
			 VALUES ('A-01', 4, 0, 0, 1, 'Jaula para cachorros.', '00B100292511104237965'),
					('A-02', 5, 0, 1, 0, 'Jaula para cachorros.', '00B100292511104237965'),
					('A-03', 3, 0, 1, 1, 'Jaula para cachorros.', '00B100292511104237965'),
					('A-04', 2, 0, 0, 1, 'Jaula para cachorros.', '00B100292511104237965'),
					('B-01', 4, 0, 1, 1, 'Jaula para perros pequeños.', '00B100292511104237965'),
					('B-02', 3, 0, 1, 0, 'Jaula para perros pequeños.', '00B100292511104237965'),
					('B-03', 2, 0, 0, 1, 'Jaula para perros pequeños.', '00B100292511104237965'),
					('B-04', 2, 0, 1, 0, 'Jaula para perros pequeños.', '00B100292511104237965'),
					('B-05', 3, 0, 1, 1, 'Jaula para perros pequeños.', '00B100292511104237965'),
                    ('C-01', 3, 0, 1, 1, 'Jaula para perros de tamaño mediano.', '00B100292511104237965'),
					('C-02', 3, 0, 1, 0, 'Jaula para perros de tamaño mediano.', '00B100292511104237965'),
					('C-03', 2, 0, 0, 1, 'Jaula para perros de tamaño mediano.', '00B100292511104237965'),
					('C-04', 2, 0, 0, 1, 'Jaula para perros de tamaño mediano.', '00B100292511104237965'),
                    ('D-01', 2, 0, 1, 1, 'Jaula para perros grandes.', '00B100292511104237965'),
					('D-02', 3, 0, 1, 0, 'Jaula para perros grandes.', '00B100292511104237965'),
					('D-03', 2, 0, 0, 1, 'Jaula para perros grandes.', '00B100292511104237965'),
					('D-04', 3, 0, 0, 1, 'Jaula para perros grandes.', '00B100292511104237965'),
					('D-05', 2, 0, 1, 0, 'Jaula para perros grandes.', '00B100292511104237965'),
					('D-06', 3, 0, 1, 1, 'Jaula para perros grandes.', '00B100292511104237965'),
                    ('E-01', 1, 0, 1, 1, 'Jaula para gatos.', '00B100292511104237966'),
					('E-02', 1, 0, 1, 0, 'Jaula para gatos.', '00B100292511104237966'),
					('E-03', 1, 0, 0, 1, 'Jaula para gatos.', '00B100292511104237966'),
					('E-04', 1, 0, 0, 1, 'Jaula para gatos.', '00B100292511104237966'),
                    ('E-05', 1, 0, 1, 1, 'Jaula para gatos.', '00B100292511104237966'),
					('E-06', 1, 0, 1, 0, 'Jaula para gatos.', '00B100292511104237966'),
					('E-07', 1, 0, 0, 1, 'Jaula para gatos.', '00B100292511104237966'),
					('E-08', 1, 0, 0, 1, 'Jaula para gatos.', '00B100292511104237966'),
					('E-09', 1, 0, 1, 0, 'Jaula para gatos.', '00B100292511104237966'),
					('E-10', 1, 0, 1, 1, 'Jaula para gatos.', '00B100292511104237966'),
                    ('E-11', 1, 0, 1, 1, 'Jaula para gatos.', '00B100292511104237966'),
					('E-12', 1, 0, 1, 0, 'Jaula para gatos.', '00B100292511104237966'),
					('E-13', 1, 0, 0, 1, 'Jaula para gatos.', '00B100292511104237966'),
                    ('F-01', 5, 0, 1, 1, 'Jaula para conejos.', '00B100292511104237967'),
					('F-02', 4, 0, 1, 0, 'Jaula para conejos.', '00B100292511104237967'),
                    ('G-01', 3, 0, 1, 1, 'Jaula para pájaros.', '00B100292511104237968'),
					('G-02', 3, 0, 1, 0, 'Jaula para pájaros.', '00B100292511104237968'),
					('G-03', 1, 0, 0, 1, 'Jaula para pájaros.', '00B100292511104237968'),
					('G-04', 1, 0, 0, 1, 'Jaula para pájaros.', '00B100292511104237968'),
                    ('G-05', 3, 0, 1, 1, 'Jaula para pájaros.', '00B100292511104237968'),
					('G-06', 3, 0, 1, 0, 'Jaula para pájaros.', '00B100292511104237968'),
                    ('H-01', 3, 0, 1, 1, 'Jaula para otras especies.', '00B100292511104237969'),
					('H-02', 3, 0, 1, 0, 'Jaula para otras especies.', '00B100292511104237969'),
					('H-03', 3, 0, 0, 1, 'Jaula para otras especies.', '00B100292511104237969'),
					('H-04', 2, 0, 0, 1, 'Jaula para otras especies.', '00B100292511104237969');
                    
                                                    
use perrera;
/*			INSERT ANIMALES			*/						
INSERT INTO `animales` (`nombre`, `especies_id`, `raza`, `genero`, `tamanio`, `peso`, `colores`, `personalidad`, `fech_nac`, `estado_adopcion`, `estado_salud`, `necesidades_especiales`, `otras_observaciones`, `jaulas_id`, `disponible`) VALUES
('Max', '00B100292511104237965', 'No especificada', 'M', 'Pequeño', 4.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00B100292511104237965', 1),
('Luna', '00B100292511104237965', 'No especificada', 'F', 'Pequeño', 5.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00B100292511104237965', 1),
('Buddy', '00B100292511104237965', 'No especificada', 'M', 'Pequeño', 3.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00B100292511104237965', 1),
('Bailey', '00B100292511104237965', 'No especificada', 'M', 'Pequeño', 2.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00B100292511104237965', 1),
('Rocky', '00B100292511104237965', 'No especificada', 'M', 'Pequeño', 4.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816010', 1),
('Coco', '00B100292511104237965', 'No especificada', 'F', 'Pequeño', 3.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816011', 1),
('Milo', '00B100292511104237965', 'No especificada', 'M', 'Pequeño', 2.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816012', 1),
('Lola', '00B100292511104237965', 'No especificada', 'F', 'Pequeño', 2.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816013', 1),
('Teddy', '00B100292511104237965', 'No especificada', 'M', 'Pequeño', 3.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816014', 1),
('Sophie', '00B100292511104237965', 'No especificada', 'F', 'Mediano', 3.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816015', 1),
('Ziggy', '00B100292511104237965', 'No especificada', 'M', 'Mediano', 3.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816016', 1),
('Oliver', '00B100292511104237965', 'No especificada', 'M', 'Mediano', 2.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816017', 1),
('Ruby', '00B100292511104237965', 'No especificada', 'F', 'Mediano', 2.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816018', 1),
('Daisy', '00B100292511104237965', 'No especificada', 'F', 'Grande', 2.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816019', 1),
('Mia', '00B100292511104237965', 'No especificada', 'F', 'Grande', 3.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816020', 1),
('Toby', '00B100292511104237965', 'No especificada', 'M', 'Grande', 2.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816021', 1),
('Sadie', '00B100292511104237965', 'No especificada', 'F', 'Grande', 3.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816022', 1),
('Bailey', '00B100292511104237965', 'No especificada', 'M', 'Grande', 2.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816023', 1),
('Luna', '00B100292511104237966', 'No especificada', 'F', 'Pequeño', 1.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816025', 1),
('Simba', '00B100292511104237966', 'No especificada', 'M', 'Pequeño', 1.00, 'No especificado', '-', '2024-05-01', 'Disponible', 'Bien', 'NO', '-', '00J100823587618816026', 1);


							
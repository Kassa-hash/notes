INSERT INTO users (name, email, email_verified_at, password, remember_token, created_at, updated_at)
VALUES 
('Alice Dupont', 'alice@example.com', NOW(), '$2y$10$CwTycUXWue0Thq9StjUM0uJ8FQ1uA9tIKzFJ6XbQK0gqYzqFy2R4.', NULL, NOW(), NOW()),
('Bob Martin', 'bob@example.com', NOW(), '$2y$10$wH6z9D1nDg1FHT/5p0H2.u1HQzOZp7A8G7D.Nkz0GQ9r3H1bF56e2', NULL, NOW(), NOW()),
('Charlie Nguyen', 'charlie@example.com', NULL, '$2y$10$O9yH7gXnFq1RZ2H7uE0uC.8jGk2bJ7H8QZf6B9R0L1sP6Xn2K7lO.', NULL, NOW(), NOW());

Alice Dupont	alice@example.com
	password123
Bob Martin	bob@example.com
	secret456
Charlie Nguyen	mypassword789

INSERT INTO classes (libelle, created_at, updated_at) VALUES
('L1 Informatique', NOW(), NOW()),
('L2 Informatique', NOW(), NOW()),
('L3 Informatique', NOW(), NOW()),
('M1 Génie Logiciel', NOW(), NOW()),
('M2 Réseaux et Sécurité', NOW(), NOW());

INSERT INTO model_has_roles (role_id, model_type, model_id)
VALUES (4, 'App\\Models\\User', 10);
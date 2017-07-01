--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dgn_customers`
--
ALTER TABLE `dgn_customers`
  ADD CONSTRAINT `dgn_customers_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `dgn_people` (`person_id`);

--
-- Filtros para la tabla `dgn_grants`
--
ALTER TABLE `dgn_grants`
  ADD CONSTRAINT `dgn_grants_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `dgn_permissions` (`permission_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dgn_grants_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `dgn_users` (`person_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `dgn_permissions`
--
ALTER TABLE `dgn_permissions`
  ADD CONSTRAINT `dgn_permissions_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `dgn_modules` (`module_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `dgn_users`
--
ALTER TABLE `dgn_users`
  ADD CONSTRAINT `dgn_users_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `dgn_people` (`person_id`);


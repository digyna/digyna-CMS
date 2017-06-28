--
-- Constraints for dumped tables
--

--
-- Constraints for table `dgn_customers`
--
ALTER TABLE `dgn_customers`
  ADD CONSTRAINT `dgn_customers_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `dgn_people` (`person_id`);

--
-- Constraints for table `dgn_users`
--
ALTER TABLE `dgn_users`
  ADD CONSTRAINT `dgn_users_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `dgn_people` (`person_id`);

--
-- Constraints for table `dgn_permissions`
--
ALTER TABLE `dgn_permissions`
  ADD CONSTRAINT `dgn_permissions_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `dgn_modules` (`module_id`) ON DELETE CASCADE;

--
-- Constraints for table `dgn_grants`
--
ALTER TABLE `dgn_grants`
  ADD CONSTRAINT `dgn_grants_ibfk_1` foreign key (`permission_id`) references `dgn_permissions` (`permission_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dgn_grants_ibfk_2` foreign key (`person_id`) references `dgn_users` (`person_id`) ON DELETE CASCADE;

